<?php

namespace Ingor\Drops;

use Illuminate\Routing\Router;
use Ingor\Drop;
use Ingor\Pages\TablePage;

class Edit extends Drop
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
