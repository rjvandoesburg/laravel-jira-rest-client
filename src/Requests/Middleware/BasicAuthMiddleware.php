<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Atlassian\JiraRest\Contracts\ClientMiddleware;
use Closure;

class BasicAuthMiddleware implements ClientMiddleware
{

    public function handle($options, Closure $next)
    {
        $options['auth'] = [
            config('atlassian.jira.auth.basic.username'),
            config('atlassian.jira.auth.basic.password')
        ];


        return $next($options);
    }
}