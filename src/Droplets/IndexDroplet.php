<?php

namespace Ingor\Droplets;

use Ingor\Droplet;
use Ingor\Pages\TablePage;

class IndexDroplet extends Droplet
{
    protected $molecules = [
        'index' => ['get', '/', TablePage::class],
    ];
}
