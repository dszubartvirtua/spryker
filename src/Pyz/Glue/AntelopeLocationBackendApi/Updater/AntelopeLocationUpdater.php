<?php

namespace Pyz\Glue\AntelopeLocationBackendApi\Updater;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeLocationBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder\ErrorResponseBuilder;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeLocationFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
        protected readonly ErrorResponseBuilder $errorResponseBuilder,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationBackendApiAttributesTransfer $antelopeLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer());
        try {
            $antelopeLocationTransfer = $this->antelopeLocationFacade->updateAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
            return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
        } catch (\Exception $e) {
            $errorTransfer = new ErrorTransfer();
            $errorTransfer->setMessage('Antelope not found');
            $errorTransfer->setParameters(
                ['code' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
            );
            $errorTransfers = new ArrayObject();
            $errorTransfers->append($errorTransfer);

            return $this->errorResponseBuilder->createErrorResponse($errorTransfers);
        }

    }
}
