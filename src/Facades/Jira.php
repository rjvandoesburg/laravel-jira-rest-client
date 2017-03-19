<?php

namespace Atlassian\JiraRest\Facades;

use Illuminate\Support\Facades\Facade;

class Jira extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return \Atlassian\JiraRest\Helpers\Jira::class;
    }

}