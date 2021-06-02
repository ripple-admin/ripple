<?php

namespace Ingor\Concerns;

use Ingor\Water;

trait HasWater
{
    /**
     * The water model instance.
     *
     * @var \Ingor\Water
     */
    protected $water;

    /**
     * Get the water model instance.
     *
     * @return \Ingor\Water
     */
    public function water()
    {
        return $this->water;
    }

    /**
     * Set the water model instance.
     *
     * @param  \Ingor\Water  $water
     * @return $this
     */
    public function setWater(Water $water)
    {
        $this->water = $water;

        return $this;
    }

    /**
     * Get the base eloquent model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function eloquent()
    {
        return $this->water->eloquent();
    }
}
