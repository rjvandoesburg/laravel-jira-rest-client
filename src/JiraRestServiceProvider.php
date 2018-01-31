<?php

namespace Atlassian\JiraRest;

use Illuminate\Support\ServiceProvider;

class JiraRestServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/jira-rest.php' => config_path('atlassian/jira-rest.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/jira-rest.php', 'atlassian.jira-rest'
        );
    }
}