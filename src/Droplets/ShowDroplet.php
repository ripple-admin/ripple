<?php

namespace Ingor\Droplets;

use Ingor\Droplet;
use Ingor\Pages\DetailPage;

class ShowDroplet extends Droplet
{
    public $methods = [
        'show',
    ];

    public function show($id)
    {
        $this->model($id);

        return $this->page(DetailPage::class);
    }

    public function routes($router)
    {
        $router->get('/{id}', [static::class, 'show']);
    }
}
