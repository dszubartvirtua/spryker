<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Creator;

use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationCreator implements AntelopeLocationCreatorInterface
{


    public function __construct(
        protected AntelopeFacadeInterface $antelopeLocationFacade,
        protected AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected AntelopeLocationMapperInterface $antelopeLocationMapper
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer());
        $antelopeLocationTransfer = $this->antelopeLocationFacade->createAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }
}
