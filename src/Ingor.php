<?php

namespace Ingor;

use Illuminate\Support\Facades\Route;

class Ingor
{
    /** @var \Ingor\Asset[] */
    public static $css = [];

    /** @var \Ingor\Asset[] */
    public static $js = [];

    /** @var \Ingor\Asset[] */
    public static $assets = [];

    public static $pluginRoutesPath = [];

    /**
     * Define the "ingor" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::namespace('\Ingor\Http\Controllers')
            ->group(__DIR__.'/../routes/ingor.php');

        foreach (static::$pluginRoutesPath as $path) {
            Route::group([], $path);
        }
    }

    /**
     * Register the plugin routes file path.
     *
     * @param  string  $path
     * @return static
     */
    public static function pluginRoutes(string $path)
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
