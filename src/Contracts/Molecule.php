<?php

namespace Ingor\Contracts;

use Ingor\Drop;
use Ingor\Water;

interface Molecule
{
    /**
     * Get the water instance.
     *
     * @return \Ingor\Water
     */
    public function water();

    /**
     * Set the water instance.
     *
     * @param  \Ingor\Water  $water
     * @return $this
     */
    public function setWater(Water $water);

    /**
     * Get the drop instance.
     *
     * @return \Ingor\Drop
     */
    public function drop();

    /**
     * Set the drop instance.
     *
     * @param  \Ingor\Drop  $drop
     * @return $this
     */
    public function setDrop(Drop $drop);

    /**
     * Define the routes of the molecule.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    public function routes($router);

    /**
     * Set the molecule route.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  string|null  $name
     * @return $this
     */
    public function setRoute(string $method, string $path, ?string $name = null);
}
