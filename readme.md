# Doppy Routing Bundle

A Symfony2/Symfony3 bundle providing some additional routing functionality based on the symfony/cmf-routing.

## installation

### add to composer

````
    "require": {
        "doppy/routing-bundle": "^1.0.0",
    }
````

### add to AppKernel

````
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Doppy\RoutingBundle\DoppyRoutingBundle(),
            // ...
        );
    }
````

### add routers

To add routers you can tag your router:

````
services:
    your_bundle.routing.router:
        class: Your\Bundle\Routing\Router
        tags:
            - { name: doppy_routing.router, priority: 1000 }
````

Note that the default symfony router is replaced with a ChainRouter, the original is added automatically.