<?php

namespace Rjvandoesburg\Jira\Facades;

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
        return \Rjvandoesburg\Jira\Helpers\Jira::class;
    }

}