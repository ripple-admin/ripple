<?php

namespace Ingor;

use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ingor\Exceptions\Handler as ExceptionHandler;
use Ingor\Pagination\Paginator;
use Ingor\Routing\IngorRouteMethods;

class IngorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerExceptionHandler();
        $this->registerPaginator();
        $this->registerRouteMixin();
    }

    public function boot()
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerFactories();
        $this->publishFiles();
    }

    public function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
    }

    public function registerPaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, Paginator::class);
    }

    public function registerRouteMixin()
    {
        Route::mixin(new IngorRouteMethods);
    }

    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ingor-admin');
    }

    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function registerFactories()
    {
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
    }

    public function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../config/ingor.php' => config_path('ingor.php'),
        ], 'ingor-admin-config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'ingor-admin-migrations');
    }
}
