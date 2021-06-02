<?php

namespace Ingor\Droplets;

use Illuminate\Routing\Router;
use Ingor\Droplet;
use Ingor\Pages\TablePage;

class DestroyDroplet extends Droplet
{
    public $methods = [
        'destroy',
    ];

    public function destroy()
    {
        // return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        // $router->get('/', $this->water->action('index'));
    }
}
