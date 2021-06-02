<?php

namespace Ingor\Droplets;

use Ingor\Actions\StoreResource;
use Ingor\Droplet;
use Ingor\Pages\MyPage;

class CreateDroplet extends Droplet
{
    protected $molecules = [
        'create' => ['get',  '/create', MyPage::class],
        'store' =>  ['post', '/store',  StoreResource::class],
    ];
}
