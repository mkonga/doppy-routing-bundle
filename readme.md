# Doppy Routing Bundle

A Symfony2/Symfony3 bundle providing some additional routing functionality based on the symfony/cmf-routing.

This bundle only provides easy configuration and not actual code, as the Chain router is provided by symfony/cmf-routing.

## Installation

### Add to composer

````
    "require": {
        "doppy/routing-bundle": "^2.0.0",
    }
````

### Add to AppKernel

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

### Write your own router

Implement your own router in your own bundle somewhere. You will need to use one or more of the following interfaces:

* `Symfony\Component\Routing\Generator\UrlGeneratorInterface`  
For generating url's only. Useful if you want to generate url's that go to a completely different site.
* `Symfony\Component\Routing\Matcher\UrlMatcherInterface`  
For simple matching incoming url's to a controller.
* `Symfony\Component\Routing\Matcher\RequestMatcherInterface`  
For more complex matching incoming url's to a controller.

See the Symfony documentation (on those interfaces) for more information on generating and matching url's.

Define this as a service as usual.

### Add routers

There are 2 ways to make your own router known, both have the same result.

You should not use both at the same time for the same router, as that would result in your router being added multiple times.

#### Method 1: configuration

Using the main configuration:

````
doppy_routing:
    chain:
        routers_by_id:
            your_bundle.routing.router: 200
````
Where the number is the priority to use.

#### Method 2: tag

````
services:
    your_bundle.routing.router:
        class: Your\Bundle\Routing\Router
        tags:
            - { name: doppy_routing.router, priority: 200 }
````

Using this method you don't need to add the symfony router manually, as this is done automatically.

### Default Symfony router

The default symfony router is added by default with priority 100. You can adjust this with by adjusting the configuration in 2 ways:

Disable the default router:

````
doppy_routing:
    default_router: false
````

Or a different priority:

````
doppy_routing:
    default_router: -100
````
