<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApi\Controller\AntelopeLocationResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopeLocationResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
 /**
  * @inheritDoc
  */
    public function getType(): string
    {
        return AntelopeLocationBackendApiConfig::RESOURCE_ANTELOPE_LOCATION;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return AntelopeLocationResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $collection = new GlueResourceMethodCollectionTransfer();
        $method = new GlueResourceMethodConfigurationTransfer();
        $attributes = AntelopeLocationBackendApiAttributesTransfer::class;
        $method->setAttributes($attributes);

        $collection->setGetCollection($method);

        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPut((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setDelete(new GlueResourceMethodConfigurationTransfer());

        return $collection;
    }
}
