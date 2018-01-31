<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Atlassian\JiraRest\Contracts\ClientMiddleware;
use Closure;
use Atlassian\JiraRest\Requests\Auth\SessionRequest;

class CookieAuthMiddleware implements ClientMiddleware
{


    public function handle($options, Closure $next)
    {
        if ($cookie = cache()->get('jira_cookie', false)) {
            $cookie = json_decode($cookie);

            $options['headers']['cookie'] = $cookie->name .'='.$cookie->value;
        } else {
            $sessionRequest = new SessionRequest();
            $cookie = $sessionRequest->post([
                'username' => config('atlassian.jira-rest.auth.basic.username'),
                'password' => config('atlassian.jira-rest.auth.basic.password')
            ]);

            $cookie = json_decode($cookie);

            $options['headers']['cookie'] = $cookie->name .'='.$cookie->value;
        }


        return $next($options);
    }
}