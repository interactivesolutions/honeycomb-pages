<?php

namespace interactivesolutions\honeycombpages\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCPagesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombpages\app\http\controllers';

    public $serviceProviderNameSpace = 'HCPages';
}





