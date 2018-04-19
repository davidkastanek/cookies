<?php

namespace Gutter\Cookies\DI;

use Gutter\Cookies\Manager;
use Nette\DI\CompilerExtension;

class CookiesExtension extends CompilerExtension
{
    public $defaults = [
        'maxAge' => '1 month'
    ];

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('service'))->setFactory(Manager::class, [$config['maxAge']]);
    }
}
