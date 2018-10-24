<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Atlassian\JiraRest\JiraRestServiceProvider as Provider;
use Closure;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Arr;

class OAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param $options
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($options, Closure $next)
    {
        $stack = HandlerStack::create();

        if (config(Provider::CONFIG_KEY.'.auth.oauth.impersonate')) {
            $userId = null;

            if ($options['userId']) {
                $userId = $options['userId'];
            } else if (auth()->check()) {
                $userId = auth()->user()->name;
            }
            if ($userId) {
                $stack->push(new ImpersonateMiddleware($userId));
            }
        }

        $token = '';
        $tokenSecret = '';

        // For a request-token request these need to be empty to prevent a 401
        if (! session()->pull(Provider::CONFIG_KEY.'.oauth.initial-request', false)) {
            // Check if the session has values
            if (session()->has(Provider::CONFIG_KEY.'.oauth.tokens')) {
                $token = session()->get(Provider::CONFIG_KEY.'.oauth.tokens.oauth_token');
                $tokenSecret = session()->get(Provider::CONFIG_KEY.'.oauth.tokens.oauth_token_secret');
            } else {
                // Get the default tokens from the config
                $token = config(Provider::CONFIG_KEY.'.auth.oauth.oauth_token', '');
                $tokenSecret = config(Provider::CONFIG_KEY.'.auth.oauth.oauth_token_secret', '');
            }
        }

        $middleware = new Oauth1([
            'consumer_key'           => config(Provider::CONFIG_KEY.'.auth.oauth.consumer_key'),
            'consumer_secret'        => config(Provider::CONFIG_KEY.'.auth.oauth.consumer_secret'),
            'token'                  => $token,
            'token_secret'           => $tokenSecret,
            'private_key_file'       => config(Provider::CONFIG_KEY.'.auth.oauth.private_key'),
            'private_key_passphrase' => config(Provider::CONFIG_KEY.'.auth.oauth.private_key_passphrase'),
            'signature_method'       => Oauth1::SIGNATURE_METHOD_RSA,
        ]);

        $stack->push($middleware);

        $options['auth'] = 'oauth';
        $options['handler'] = $stack;

        return $next($options);
    }

}
