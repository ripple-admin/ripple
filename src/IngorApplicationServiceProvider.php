<?php

namespace Ingor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ingor\Component;
use Ingor\Http\Middleware\Authenticate;
use Ingor\Http\Middleware\RedirectIfAuthenticated;
use Ingor\Routing\Redirector;

class IngorApplicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRedirector();
        $this->registerConfig();
        $this->registerClassesNamespacesPrefix();
    }

    public function boot()
    {
        $this->registerMiddlewares();
        $this->registerRoutes();
        $this->addZiggyConfig();
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

    public function addZiggyConfig()
    {
        $this->app['config']['ziggy.blacklist'] = collect($this->app['config']['ziggy.blacklist'])
            ->concat(['debugbar.*', 'horizon.*', 'ignition.*', 'ingor.*'])
            ->unique()
            ->all();

        $this->app['config']['ziggy.groups.ingor'] = ['ingor.*'];
    }

    public function registerClassesNamespacesPrefix()
    {
        Component::namespace('Ingor\Components');
    }

    public function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('ingor.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('ingor.guest', RedirectIfAuthenticated::class);
    }

    public function registerRoutes()
    {
        Route::domain(config('ingor.domain'))
            ->prefix(config('ingor.prefix'))
            ->middleware(config('ingor.middleware'))
            ->namespace(config('ingor.controller'))
            ->group(base_path('admin/routes.php'));
    }
}
