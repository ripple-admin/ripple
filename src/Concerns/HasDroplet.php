<?php

namespace Ingor\Concerns;

use Ingor\Droplet;

trait HasDroplet
{
    /**
     * The droplet instance.
     *
     * @var \Ingor\Droplet
     */
    protected $droplet;

    /**
     * Get the droplet instance.
     *
     * @return \Ingor\Droplet
     */
    public function droplet()
    {
        return $this->droplet;
    }

    /**
     * Set the droplet instance.
     *
     * @param  \Ingor\Droplet  $droplet
     * @return $this
     */
    public function setDroplet(Droplet $droplet)
    {
        $this->droplet = $droplet;

        return $this;
    }
}
