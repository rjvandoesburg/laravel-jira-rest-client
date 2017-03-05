<?php

namespace Rjvandoesburg\Jira;


use Illuminate\Support\ServiceProvider;
use Rjvandoesburg\Jira\Providers\FacadeServiceProvider;

class JiraServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/jira.php' => config_path('jira.php'),
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
            __DIR__.'/../config/jira.php', 'jira'
        );

        $this->app->register(FacadeServiceProvider::class);
    }
}