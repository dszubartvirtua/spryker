<?php

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\Deleter;

use ArrayObject;
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

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeLocationFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
        protected readonly ErrorResponseBuilder $errorResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $isDeleted = $this->antelopeLocationFacade->deleteAntelopeLocation($antelopeLocationTransfer);
        if (!$isDeleted) {
            $errorTransfer = new ErrorTransfer();
            $errorTransfer->setMessage('Antelope not found');
            $errorTransfer->setParameters(
                ['code' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
            );
            $errorTransfers = new ArrayObject();
            $errorTransfers->append($errorTransfer);

            return $this->errorResponseBuilder->createErrorResponse($errorTransfers);
        }

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(new AntelopeLocationCollectionTransfer());
    }
}
