<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;
use Spryker\Service\Container\Exception\FrozenServiceException;

class AntelopeLocationBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const string FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';

    /**
     * @throws FrozenServiceException
     */
    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        return $this->addAntelopeLocationFacade($container);
    }

    /**
     * @throws FrozenServiceException
     */
    protected function addAntelopeLocationFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE_LOCATION, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }
}
