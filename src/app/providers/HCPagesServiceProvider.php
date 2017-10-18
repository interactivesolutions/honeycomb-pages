<?php

namespace interactivesolutions\honeycombpages\app\providers;


use InteractiveSolutions\HoneycombCore\Providers\HCBaseServiceProvider;

class HCPagesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombpages\app\http\controllers';

    public $serviceProviderNameSpace = 'HCPages';
}





