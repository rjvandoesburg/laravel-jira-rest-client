<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Atlassian\JiraRest\Requests\RequestBody;
use Closure;

class FilterAcceptedOptions
{


    public function handle(RequestBody $requestBody, Closure $next)
    {
        $availableOptions = $requestBody->getRequest()->getAvailableOptions($requestBody->getMethod());

        $options = collect($requestBody->getOptions())
            ->mapWithKeys(function ($value, $option) {
            // Just in case we want to use lower case :)
            return [camel_case($option) => $value];
        })->filter(function ($value, $option) use ($availableOptions) {
            if (empty($availableOptions)) {
                return false;
            }
            return in_array($option, $availableOptions);
        })->toArray();

        $requestBody->setOptions($options);

        return $next($requestBody);
    }
}