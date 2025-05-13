<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\AntelopeLocationBackendApiConfig;

class AntelopeLocationResponseBuilder implements AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer): GlueResponseTransfer
    {
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $location) {
            $resource = $this->mapAntelopeDtoToGlueResourceTransfer($location);
            $responseTransfer->addResource($resource);
        }
        $responseTransfer->setPagination($antelopeLocationCollectionTransfer->getPagination());

        return $responseTransfer;
    }

    protected function mapAntelopeDtoToGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocationTransfer): GlueResourceTransfer
    {
        $resource = new GlueResourceTransfer();
        $resource->setType(AntelopeLocationBackendApiConfig::RESOURCE_ANTELOPE_LOCATION);
        $resource->setId('' . $antelopeLocationTransfer->getIdAntelopeLocation());
        $attributes = new AntelopesBackendApiAttributesTransfer();
        $attributes->fromArray($antelopeLocationTransfer->toArray(), true);

        $resource->setAttributes($attributes);

        return $resource;
    }
}
