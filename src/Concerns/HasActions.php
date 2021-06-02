<?php

namespace Ingor\Concerns;

use Ingor\Droplet;

trait HasActions
{
    /**
     * Get the action instance.
     *
     * @param  string  $action
     * @param  array  $parameters
     * @return \Ingor\Action
     */
    public function action(string $action, array $parameters = [])
    {
        /** @var \Ingor\Action $action */
        $action = app($action, $parameters);

        if ($this instanceof Droplet) {
            $action->setDroplet($this);
        }

        return $action;
    }
}
