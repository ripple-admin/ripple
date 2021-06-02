<?php

namespace Ingor\Drops;

use Illuminate\Routing\Router;
use Ingor\Drop;
use Ingor\Pages\TablePage;

class Destroy extends Drop
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
