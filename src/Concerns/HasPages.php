<?php

namespace Ingor\Concerns;

use Ingor\Droplet;

trait HasPages
{
    /**
     * Make a new page instance.
     *
     * @param  string  $page
     * @param  array  $parameters
     * @return \Ingor\Page
     */
    public function page(string $page, array $parameters = [])
    {
        /** @var \Ingor\Page $page */
        $page = app($page, $parameters);

        if ($this instanceof Droplet) {
            $page->setDroplet($this);
        }

        $page->boot();

        return $page;
    }
}
