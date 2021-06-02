<?php

namespace Ingor;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use Ingor\Concerns\Molecules;
use Ingor\Drops\Create;
use Ingor\Drops\Destroy;
use Ingor\Drops\Edit;
use Ingor\Drops\Index;
use Ingor\Drops\Show;

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
     * Define the drops of water.
     *
     * @var array
     */
    protected $drops = [
        Index::class,
        Create::class,
        // Show::class,
        // Edit::class,
        // Destroy::class,
    ];

    /**
     * The drops instance.
     *
     * @var array
     */
    protected $loadedDrops = [];

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
        $this->bootDrops();
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
     * Bootstrap all drops instance.
     *
     * @return void
     */
    public function bootDrops()
    {
        foreach ($this->drops as $className) {
            /** @var \Ingor\Drop $drop */
            $drop = new $className($this);
            $drop->fields($this->fields());

            $this->addDrop($drop);
        }
    }

    /**
     * Get all drops instance.
     *
     * @return \Ingor\Drop[]
     */
    public function drops(): array
    {
        return $this->drops;
    }

    /**
     * Get the drop instance.
     *
     * @param  string  $name
     * @return \Ingor\Drop
     */
    public function drop(string $name)
    {
        return $this->drops[$name];
    }

    /**
     * Add a new drop instance.
     *
     * @param  \Ingor\Drop  $drop
     * @return $this
     */
    public function addDrop(Drop $drop)
    {
        $this->loadedDrops[get_class($drop)] = $drop;
        $this->mergeMolecules($drop);

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
            $this->registerDropsRoutes($router);
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
     * Register the drops routes.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    protected function registerDropsRoutes($router)
    {
        /** @var \Ingor\Drop $drop */
        foreach ($this->loadedDrops as $className => $drop) {
            $drop->routes($router);
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
        if (isset($this->loadedMolecules[$resourceName = Str::snake($method)])) {
            return $this->loadedMolecules[$resourceName];
        }

        static::throwBadMethodCallException($method);
    }
}
