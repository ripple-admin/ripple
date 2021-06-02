<?php

namespace Ingor;

use Illuminate\Support\Facades\Route;
use InvalidArgumentException;

class Ingor
{
    /** @var \Ingor\Water[] */
    public static $waters = [];

    /** @var \Ingor\Asset[] */
    public static $css = [];

    /** @var \Ingor\Asset[] */
    public static $js = [];

    /** @var \Ingor\Asset[] */
    public static $assets = [];

    public static $pluginRoutesPath = [];

    /**
     * Add a Water class into Ingor.
     *
     * @param  string  $class
     * @return static
     */
    public static function water(string $class)
    {
        $water = app($class);

        if (! $water instanceof Water) {
            throw new InvalidArgumentException(
                sprintf('The argument $class must be an instance of %s.', Water::class)
            );
        }

        static::$waters[] = $water;

        return new static;
    }

    /**
     * Register the "ingor" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::group([], __DIR__.'/../routes/ingor.php');
    }

    /**
     * Register the Water routes.
     *
     * @return void
     */
    public static function waterRoutes()
    {
        /** @var \Ingor\Water $water */
        foreach (static::$waters as $water) {
            $water->registerRoutes(app('router'));
        }
    }

    /**
     * Register the Ingor plugins routes.
     *
     * @return void
     */
    public static function pluginRoutes()
    {
        foreach (static::$pluginRoutesPath as $path) {
            Route::group([], $path);
        }
    }

    /**
     * Add the plugin routes file path.
     *
     * @param  string  $path
     * @return static
     */
    public static function addPluginRoutes(string $path)
    {
        static::$pluginRoutesPath[] = $path;

        return new static;
    }

    /**
     * Add the CSS files include to Ingor.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function css(string $path, string $manifestDirectory = '')
    {
        static::$css[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Add the JS files include to Ingor.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function js(string $path, string $manifestDirectory = '')
    {
        static::$js[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Add the asset to Ingor.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function asset(string $path, string $manifestDirectory = '')
    {
        static::$assets[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Get the Ingor styles assets instance.
     *
     * @return array
     */
    public static function styles()
    {
        return static::$css;
    }

    /**
     * Get the Ingor scripts assets instance.
     *
     * @return array
     */
    public static function scripts()
    {
        return static::$js;
    }

    /**
     * Get the Ingor asset instance.
     *
     * @param  string  $path
     * @return \Ingor\Asset|null
     */
    protected function getAsset(string $path)
    {
        return array_merge(
            static::$assets,
            static::$css,
            static::$js
        )[$path] ?? null;
    }
}
