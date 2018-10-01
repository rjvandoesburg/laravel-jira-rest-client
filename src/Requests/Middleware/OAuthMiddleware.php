<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Closure;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

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

        if (config('atlassian.jira.auth.oauth.impersonate')) {
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

        $middleware = new Oauth1([
            'consumer_key'           => config('atlassian.jira.auth.oauth.consumer_key'),
            'consumer_secret'        => config('atlassian.jira.auth.oauth.consumer_secret'),
            'token'                  => '',
            'private_key_file'       => config('atlassian.jira.auth.oauth.private_key'),
            'private_key_passphrase' => config('atlassian.jira.auth.oauth.private_key_passphrase'),
            'signature_method'       => Oauth1::SIGNATURE_METHOD_RSA,
        ]);

        $stack->push($middleware);

        $options['auth'] = 'oauth';
        $options['handler'] = $stack;

        return $next($options);
    }

}
