<?php

namespace Ingor\Droplets;

use Illuminate\Routing\Router;
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

    public function routes(Router $router)
    {
        $router->get('/{id}', $this->water->action('show'));
    }
}
