<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Closure;

class SudoMiddleware
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
        // If we have a user, set it as the user communicating with Jira
        if (auth()->user()) {
            $options['headers']['sudo'] = auth()->user()->email;
        }

        return $next($options);
    }
}