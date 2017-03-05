<?php

namespace Doppy\RoutingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('doppy_routing');

        $rootNode
            ->children()
                ->arrayNode('chain')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('routers_by_id')
                            ->useAttributeAsKey('id')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->scalarNode('default_router')->defaultValue(100)->end()
            ->end();

        return $treeBuilder;
    }
}
