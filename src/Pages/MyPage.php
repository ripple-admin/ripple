<?php

namespace Ingor\Pages;

use Ingor\Page;

class MyPage extends Page
{
    protected $name = 'Page';

    protected $title = 'My Page';

    protected function pageProps(): array
    {
        return [];
    }
}
