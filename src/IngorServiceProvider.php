<?php

namespace Ingor;

use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;
use Ingor\Exceptions\Handler as ExceptionHandler;
use Ingor\Http\Middleware\Authenticate;
use Ingor\Http\Middleware\RedirectIfAuthenticated;
use Ingor\Pagination\Paginator;
use Ingor\Routing\Redirector;

class IngorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();
        $this->registerExceptionHandler();
        $this->registerPaginator();
        $this->registerRedirector();
    }

    public function boot()
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerFactories();
        $this->registerMiddlewares();
        $this->addZiggyConfig();
        $this->publishFiles();
    }

    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ingor.php', 'ingor');

        // Merge auth guards and auth providers to Laravel config
        $this->app['config']['auth.guards'] = array_merge(
            $this->app['config']['auth.guards'],
            $this->app['config']['ingor.auth.guards']
        );
        $this->app['config']['auth.providers'] = array_merge(
            $this->app['config']['auth.providers'],
            $this->app['config']['ingor.auth.providers']
        );
    }

    public function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
    }

    public function registerPaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, Paginator::class);
    }

    protected function registerRedirector()
    {
        $this->app->singleton('ingor.redirect', function ($app) {
            $redirector = new Redirector($app['url']);

            if (isset($app['session.store'])) {
                $redirector->setSession($app['session.store']);
            }

            return $redirector;
        });
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

    public function addZiggyConfig()
    {
        $this->app['config']['ziggy.blacklist'] = collect($this->app['config']['ziggy.blacklist'])
            ->concat(['debugbar.*', 'horizon.*', 'ignition.*', 'ingor.*'])
            ->unique()
            ->all();

        $this->app['config']['ziggy.groups.ingor'] = ['ingor.*'];
    }

    public function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('ingor.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('ingor.guest', RedirectIfAuthenticated::class);
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
