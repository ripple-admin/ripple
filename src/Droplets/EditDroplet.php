<?php

namespace Ingor\Droplets;

use Illuminate\Routing\Router;
use Ingor\Droplet;
use Ingor\Pages\TablePage;

class EditDroplet extends Droplet
{
    public $methods = [
        'edit',
    ];

    public function edit()
    {
        // return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        // $router->get('/', $this->water->action('index'));
    }
}
