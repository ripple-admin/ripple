<?php

namespace Ingor\Contracts;

use Illuminate\Routing\Router;

interface Routable
{
    /**
     * Register the current class route.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function registerRoute(Router $router): void;
}
