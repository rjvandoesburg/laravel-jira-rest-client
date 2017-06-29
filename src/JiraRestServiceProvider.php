<?php

namespace Atlassian\JiraRest;

use Illuminate\Support\ServiceProvider;
use Atlassian\JiraRest\Providers\FacadeServiceProvider;

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
            __DIR__.'/Config/jira.php' => config_path('atlassian/jira.php'),
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
            __DIR__.'/Config/jira.php', 'atlassian.jira'
        );

        $this->app->register(FacadeServiceProvider::class);
    }
}