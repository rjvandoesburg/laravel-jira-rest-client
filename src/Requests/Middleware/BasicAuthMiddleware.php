<?php

namespace Atlassian\JiraRest;

use Closure;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BasicAuthMiddleware implements ClientMiddleware
{


    public function handle($options, Closure $next)
    {
        $options['auth'] = [
            config('atlassian.jira-rest.auth.basic.username'),
            config('atlassian.jira-rest.auth.basic.password')
        ];


        return $next($options);
    }
}