<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Closure;

class BasicApiTokenMiddleware
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
        $authorizationHeader = base64_encode(
            config('atlassian.jira.auth.basic_token.username').':'.config('atlassian.jira.auth.basic_token.token')
        );
        
        $options['headers']['Authorization'] = 'Basic ' . $authorizationHeader;

        return $next($options);
    }
}
