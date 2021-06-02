<?php

namespace Ingor;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Traits\Macroable;
use Ingor\Concerns\HasDroplet;
use Ingor\Concerns\HasWater;
use Ingor\Contracts\Routable;

abstract class Action implements Routable
{
    use Macroable;
    use HasWater;
    use HasDroplet;

    /**
     * Handle the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void|\Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable
     */
    abstract public function handle(Request $request);

    /**
     * Register the current class route.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    abstract public function registerRoute(Router $router): void;
}
