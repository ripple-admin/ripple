<?php

namespace Ingor\Concerns;

use Ingor\Drop;

trait HasDrop
{
    /**
     * The drop instance.
     *
     * @var \Ingor\Drop
     */
    protected $drop;

    /**
     * Get the drop instance.
     *
     * @return \Ingor\Drop
     */
    public function drop()
    {
        return $this->drop;
    }

    /**
     * Set the drop instance.
     *
     * @param  \Ingor\Drop  $drop
     * @return $this
     */
    public function setDrop(Drop $drop)
    {
        $this->drop = $drop;

        return $this;
    }
}
