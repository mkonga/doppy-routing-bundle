<?php

namespace Doppy\RoutingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DoppyRoutingExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // get router definition
        $router = $container->getDefinition('doppy_routing.router');

        // add default router if configured
        if ($config['default_router'] !== false) {
            $router->addMethodCall('add', array(new Reference('router.default'), $config['default_router']));
        }

        // add manually configured routers
        foreach ($config['chain']['routers_by_id'] as $id => $priority) {
            $router->addMethodCall('add', array(new Reference($id), trim($priority)));
        }

    }
}
