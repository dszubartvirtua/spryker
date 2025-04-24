<?php

namespace Pyz\Client\Antelope;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AntelopeDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ANTELOPE_REQUEST = 'CLIENT_ANTELOPE_REQUEST';

    public function provideServiceLayerDependencies(Container $container): Container {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addZedRequestClient($container);
        return $container;
    }

    public function addZedRequestClient(Container $container): Container
    {
        $container->set(static::CLIENT_ANTELOPE_REQUEST,
            function (Container $container) {
                return $container->getLocator()->zedRequest()->client();
            });
        return $container;
    }
}
