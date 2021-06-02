<?php

namespace Ingor;

use Ingor\AbstractComponent;
use Ingor\Contracts\InertiaRenderable;
use JsonSerializable;

abstract class Component extends AbstractComponent implements JsonSerializable, InertiaRenderable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name(),
            'props' => $this->props(),
        ];
    }

    /**
     * Get value in serialized by json encode().
     *
     * @return array
     */
    public function jsonSerialize() {
        return $this->toArray();
    }
}
