<?php

namespace Ingor\Pages;

use Ingor\Components\Table;
use Ingor\Page;

class TablePage extends Page
{
    protected $name = 'List/Table';

    protected $title = 'Table page';

    public function columns()
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
            'table' => Table::make()
                ->setColumns($this->columns())
                ->setData($this->data()),
        ];
    }
}
