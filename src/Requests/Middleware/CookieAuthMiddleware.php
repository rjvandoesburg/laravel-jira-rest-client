<?php

namespace Atlassian\JiraRest;

use Closure;
use Atlassian\JiraRest\Requests\Auth\Session;

class CookieAuthMiddleware implements ClientMiddleware
{


    public function handle($options, Closure $next)
    {
        if ($cookie = cache()->get('jira_cookie', false)) {
            $cookie = json_decode($cookie);

            $options['headers']['cookie'] = $cookie->name .'='.$cookie->value;
        } else {
            $sessionRequest = new Session();
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