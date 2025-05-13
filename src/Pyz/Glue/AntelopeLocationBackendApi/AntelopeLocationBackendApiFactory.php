<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi;

use Pyz\Glue\AntelopeLocationBackendApi\Processor\Creator\AntelopeLocationCreator;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Deleter\AntelopeLocationDeleter;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Expander\AntelopeLocationExpander;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapper;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Reader\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Reader\AntelopeLocationReaderInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilder;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\ErrorResponseBuilder;
use Pyz\Glue\AntelopeLocationBackendApi\Updater\AntelopeLocationUpdater;
use Pyz\Glue\AntelopeLocationBackendApi\Updater\AntelopeLocationUpdaterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;
use Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException;

class AntelopeLocationBackendApiFactory extends AbstractFactory
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader(
            $this->getAntelopeLocationFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationExpander(),
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeLocationFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationBackendApiDependencyProvider::FACADE_ANTELOPE_LOCATION);
    }

    public function createAntelopeLocationResponseBuilder(
    ): AntelopeLocationResponseBuilderInterface
    {
        return new AntelopeLocationResponseBuilder();
    }

    public function createAntelopeLocationExpander(): AntelopeLocationExpanderInterface
    {
        return new AntelopeLocationExpander();
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationWriter(): AntelopeLocationCreator
    {
        return new AntelopeLocationCreator($this->getAntelopeLocationFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper()
        );
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapperInterface
    {
        return new AntelopeLocationMapper();
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationUpdater(): AntelopeLocationUpdaterInterface
    {
        return new AntelopeLocationUpdater(
            $this->getAntelopeLocationFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
            $this->createErrorResponseBuilder(),
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationDeleter(): AntelopeLocationDeleter
    {
        return new AntelopeLocationDeleter(
            $this->getAntelopeLocationFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
            $this->createErrorResponseBuilder(),
        );
    }

    private function createErrorResponseBuilder(): ErrorResponseBuilder
    {
        return new ErrorResponseBuilder();
    }
}
