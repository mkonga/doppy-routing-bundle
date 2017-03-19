<?php

namespace Doppy\RoutingBundle\DependencyInjection\CompilerPass;

use Doppy\UtilBundle\Helper\CompilerPass\BaseTagServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class ChainRouterCompilerPass extends BaseTagServiceCompilerPass
{
    protected function handleTag(
        ContainerBuilder $containerBuilder,
        Definition $serviceDefinition,
        Reference $taggedServiceReference,
        $attributes
    )
    {
        $serviceDefinition->addMethodCall(
            'add',
            array(
                $taggedServiceReference,
                $attributes['priority']
            )
        );
    }

    protected function getService(ContainerBuilder $containerBuilder)
    {
        return $containerBuilder->getDefinition('doppy_routing.router');
    }

    protected function getTaggedServices(ContainerBuilder $containerBuilder)
    {
        return $containerBuilder->findTaggedServiceIds('doppy_routing.router');
    }
}
