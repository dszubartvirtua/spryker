<?php

namespace Pyz\Yves\AntelopePage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AntelopePageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const string ROUTE_NAME_TRAINING_ANTELOPE_NAME = 'antelope/antelope/';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        return $this->addTrainingAntelopeGetRoute($routeCollection);
    }

    private function addTrainingAntelopeGetRoute(
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute(
            'antelopes',
            'AntelopePage',
            'Antelope',
            'indexAction'
        );
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_TRAINING_ANTELOPE_NAME, $route);

        return $routeCollection;
    }
}
