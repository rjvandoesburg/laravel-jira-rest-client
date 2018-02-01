<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Closure;

class BasicAuthMiddleware
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
        $options['auth'] = [
            config('atlassian.jira.auth.basic.username'),
            config('atlassian.jira.auth.basic.password'),
        ];

        return $next($options);
    }
}