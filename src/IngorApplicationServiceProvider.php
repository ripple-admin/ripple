<?php

namespace Ingor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class IngorApplicationServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $waters = [];

    public function register()
    {
        $this->registerClassesNamespacesPrefix();
        $this->registerWaters();
    }

    public function boot()
    {
        $this->registerRoutes();
    }

    public function registerClassesNamespacesPrefix()
    {
        Component::namespace('Ingor\Components');
    }

    public function registerWaters()
    {
        foreach ($this->waters as $water) {
            Ingor::water($water);
        }
    }

    public function registerRoutes()
    {
        Route::domain(config('ingor.domain'))
            ->prefix(config('ingor.prefix'))
            ->middleware(config('ingor.middleware'))
            ->group(base_path('admin/routes.php'));
    }
}
