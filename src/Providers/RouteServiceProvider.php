<?php

namespace Atlassian\JiraRest\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the module.
     *
     * @return void
     */
    public function map()
    {
        Route::namespace('Atlassian\JiraRest\Http\Controllers')
            ->middleware(['web'])
            ->group(__DIR__ . '/../Routes/jira.php');
    }
}