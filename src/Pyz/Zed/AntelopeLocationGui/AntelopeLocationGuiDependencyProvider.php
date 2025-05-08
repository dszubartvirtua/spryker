<?php

namespace Pyz\Zed\AntelopeLocationGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeLocationGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string PROPEL_QUERY_ANTELOPE_LOCATION = 'PROPEL_QUERY_ANTELOPE_LOCATION';
    public const FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $this->addAntelopeLocationPropelQuery($container);
        $this->addAntelopeLocationFacade($container);

        return $container;
    }

    protected function addAntelopeLocationFacade(Container $container)
    {
        $container->set(static::FACADE_ANTELOPE_LOCATION, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }

    protected function addAntelopeLocationPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_ANTELOPE_LOCATION, $container->factory(function () {
            return PyzAntelopeLocationQuery::create();
        }));

        return $container;
    }
}
