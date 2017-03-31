<?php

namespace Doppy\RoutingBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ChainRouterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $chainRouterDefinition = $container->getDefinition('doppy_routing.router');
        $taggedRouters         = $container->findTaggedServiceIds('doppy_routing.router');

        foreach ($taggedRouters as $serviceId => $tags) {
            foreach ($tags as $tag) {
                $priority = isset($tag['priority']) ? $tag['priority'] : 0;
                $chainRouterDefinition->addMethodCall(
                    'add',
                    array(
                        new Reference($serviceId),
                        $priority
                    )
                );
            }
        }
    }
}
