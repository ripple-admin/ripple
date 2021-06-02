<?php

namespace Ingor\Routing;

use Ingor\Water;

class IngorRouteMethods
{
    /**
     * Register the routes of water model.
     *
     * @param  string  $prefix
     * @param  string|\Ingor\Water  $water
     * @return callable
     */
    public function water()
    {
        return function (string $prefix, $water) {
            if (! $water instanceof Water) {
                $water = $this->container->make($water);
            }

            $water->registerRoute($this, $prefix);
        };
    }
}
