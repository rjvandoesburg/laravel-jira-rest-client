<?php

namespace Rjvandoesburg\Jira\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Rjvandoesburg\Jira\Helpers\Jira;
use Rjvandoesburg\Jira\Facades\Jira as JiraFacade;

class FacadeServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function provides()
    {
        return ['Jira'];
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JiraFacade::class, function ($app) {
            return new Jira();
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Jira', JiraFacade::class);
    }
}