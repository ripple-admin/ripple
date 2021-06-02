<?php

namespace Ingor\Drops;

use Ingor\Actions\StoreResource;
use Ingor\Drop;
use Ingor\Pages\MyPage;

class Create extends Drop
{
    protected $molecules = [
        'create' => ['get',  '/create', MyPage::class],
        'store' =>  ['post', '/store',  StoreResource::class],
    ];
}
