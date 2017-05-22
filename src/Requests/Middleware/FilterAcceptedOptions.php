<?php

namespace Atlassian\JiraRest;

use Closure;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class FilterAcceptedOptions
{


    public function handle(RequestBody $request, Closure $next)
    {
        $options = collect($request->getOptions())
            ->mapWithKeys(function ($value, $option) {
            // Just in case we want to use lowe case :)
            return [camel_case($option) => $value];
        })->filter(function ($value, $option) use ($request) {
            if (! isset($this->options[$method])) {
                return false;
            }

            return in_array($option, $this->options[$method]);
        })->toArray();

        return $next($options);
    }
}