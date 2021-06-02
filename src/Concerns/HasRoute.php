<?php

namespace Ingor\Concerns;

use Illuminate\Support\Str;

trait HasRoute
{
    /** @var string */
    protected $method = 'get';

    /** @var string */
    protected $path;

    /** @var string|null */
    protected $routeName;

    /**
     * Define the routes of the page.
     *
     * @param  \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar  $router
     * @return void
     */
    public function routes($router)
    {
        $router->{$this->method}($this->path, $this->routeAction())->name($this->routeName);
    }

    /**
     * Get the route action with page.
     *
     * @return array
     */
    protected function routeAction(): array
    {
        return [
            get_class($this->water ?? $this->droplet->water()),
            Str::camel($this->routeName),
        ];
    }

    /**
     * Set the molecule route.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  string|null  $name
     * @return $this
     */
    public function setRoute(string $method, string $path, ?string $name = null)
    {
        $this->method = $method;
        $this->path = $path;
        $this->routeName = $name;

        return $this;
    }
}
