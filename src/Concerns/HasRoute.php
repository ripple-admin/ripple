<?php

namespace Ingor\Concerns;

use Illuminate\Support\Str;
use Ingor\Water;
use InvalidArgumentException;

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
            get_class($this->water()),
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
        if (is_string($name) && method_exists($this->water(), Str::camel($name))) {
            throw new InvalidArgumentException(sprintf(
                join('', [
                    'The route name "%s" conflicts cannot used, cannot be used. ',
                    'Because has been defined method "%s()" in %s::class.',
                ]), $name, $name, Water::class
            ));
        }

        $this->method = $method;
        $this->path = $path;
        $this->routeName = $name;

        return $this;
    }
}
