<?php

namespace Ingor;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use Ingor\Concerns\Molecules;
use Ingor\Droplets\CreateDroplet;
use Ingor\Droplets\DestroyDroplet;
use Ingor\Droplets\EditDroplet;
use Ingor\Droplets\IndexDroplet;
use Ingor\Droplets\ShowDroplet;

abstract class Water extends SourceWater
{
    use Macroable;
    use Molecules;
    use ForwardsCalls;

    /**
     * The route prefix by Water.
     *
     * @var string|null
     */
    protected $prefix;

    /**
     * The original model class.
     *
     * @var string
     */
    protected $model;

    /**
     * The original model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelInstance;

    /**
     * Define the droplets of water.
     *
     * @var array
     */
    protected $droplets = [
        IndexDroplet::class,
        CreateDroplet::class,
        // ShowDroplet::class,
        // EditDroplet::class,
        // DestroyDroplet::class,
    ];

    /**
     * The droplets instance.
     *
     * @var array
     */
    protected $loadedDroplets = [];

    public function __construct()
    {
        $this->bootTraits();
        $this->boot();
    }

    /**
     * Bootstrap the water model.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootDroplets();
    }

    /**
     * Get the base eloquent model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function eloquent()
    {
        if (! $this->modelInstance) {
            $this->modelInstance = app($this->model);
        }

        return $this->modelInstance;
    }

    /**
     * Define the water model fields.
     *
     * @return array|\Ingor\Field[]
     */
    abstract public function fields(): array;

    /**
     * Bootstrap all droplets instance.
     *
     * @return void
     */
    public function bootDroplets()
    {
        foreach ($this->droplets as $className) {
            /** @var \Ingor\Droplet $droplet */
            $droplet = new $className($this);
            $droplet->fields($this->fields());

            $this->addDroplet($droplet);
        }
    }

    /**
     * Get all droplets instance.
     *
     * @return \Ingor\Droplet[]
     */
    public function droplets(): array
    {
        return $this->droplets;
    }

    /**
     * Get the droplet instance.
     *
     * @param  string  $name
     * @return \Ingor\Droplet
     */
    public function droplet(string $name)
    {
        return $this->droplets[$name];
    }

    /**
     * Add a new droplet instance.
     *
     * @param  \Ingor\Droplet  $droplet
     * @return $this
     */
    public function addDroplet(Droplet $droplet)
    {
        $this->loadedDroplets[get_class($droplet)] = $droplet;
        $this->mergeMolecules($droplet);

        return $this;
    }

    /**
     * Get the water route prefix.
     *
     * @return string
     */
    protected function prefix()
    {
        if ($this->prefix) {
            return $this->prefix;
        }

        return Str::snake(Str::pluralStudly(class_basename(static::class)));
    }

    /**
     * Register the water routes.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    public function registerRoutes($router)
    {
        $router->prefix($this->prefix())->group(function ($router) {
            $this->registerMoleculesRoutes($router);
            $this->registerDropletsRoutes($router);
            $this->routes($router);
        });
    }

    /**
     * Register the molecules routes.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    protected function registerMoleculesRoutes($router)
    {
        /** @var \Ingor\Contracts\Molecule $molecule */
        foreach ($this->loadedMolecules as $name => $molecule) {
            $molecule->routes($router);
        }
    }

    /**
     * Register the droplets routes.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    protected function registerDropletsRoutes($router)
    {
        /** @var \Ingor\Droplet $droplet */
        foreach ($this->loadedDroplets as $className => $droplet) {
            $droplet->routes($router);
        }
    }

    /**
     * Define the routes of the water model.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    protected function routes($router)
    {
        //
    }

    public function __call(string $method, array $parameters)
    {
        if (isset($this->loadedResources[$resourceName = Str::snake($method)])) {
            return $this->loadedResources[$resourceName];
        }

        static::throwBadMethodCallException($method);
    }
}
