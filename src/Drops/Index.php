<?php

namespace Ingor\Drops;

use Ingor\Drop;
use Ingor\Pages\TablePage;

class Index extends Drop
{
    protected $molecules = [
        'index' => ['get', '/', TablePage::class],
    ];
}
