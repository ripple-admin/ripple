<?php

namespace Ingor;

abstract class SourceWater
{
    /**
     * Bootstrap the water model.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Boot all of the bootable traits on the resource.
     *
     * @return void
     */
    protected function bootTraits()
    {
        foreach (class_uses_recursive($this) as $trait) {
            if (method_exists($this, $method = 'boot'.class_basename($trait))) {
                $this->{$method}();
            }
        }
    }
}
