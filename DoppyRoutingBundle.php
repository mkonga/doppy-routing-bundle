<?php

namespace Doppy\RoutingBundle;

use Doppy\RoutingBundle\DependencyInjection\CompilerPass\ChainRouterCompilerPass;
use Doppy\RoutingBundle\DependencyInjection\CompilerPass\ReplaceRouterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DoppyRoutingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ChainRouterCompilerPass());
        $container->addCompilerPass(new ReplaceRouterCompilerPass());
    }
}
