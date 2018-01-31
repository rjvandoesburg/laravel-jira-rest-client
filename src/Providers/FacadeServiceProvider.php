<?php

namespace Atlassian\JiraRest\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Atlassian\JiraRest\Helpers\Jira;
use Atlassian\JiraRest\Facades\Jira as JiraFacade;

class FacadeServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
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