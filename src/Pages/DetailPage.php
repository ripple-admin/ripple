<?php

namespace Ingor\Pages;

use Ingor\Components\Detail;
use Ingor\Page;

class DetailPage extends Page
{
    protected $name = 'List/Detail';

    protected $title = 'Detail page';

    public function fields()
    {
        return $this->drop->getFieldsLabel();
    }

    public function data()
    {
        return $this->drop->buildModelData();
    }

    protected function pageProps(): array
    {
        return [
            'detail' => Detail::make()
                ->setFields($this->fields())
                ->setData($this->data()),
        ];
    }
}
