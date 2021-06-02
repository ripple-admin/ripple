<?php

namespace Ingor\Drops;

use Ingor\Drop;
use Ingor\Pages\DetailPage;

class Show extends Drop
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
