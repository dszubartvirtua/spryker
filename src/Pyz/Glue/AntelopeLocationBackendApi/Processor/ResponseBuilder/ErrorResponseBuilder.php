<?php

namespace Pyz\Glue\AntelopeLocationBackendApi\Processor\ResponseBuilder;

use ArrayObject;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseBuilder
{
    public function __construct()
    {
    }

    /**
     * @param string $errorMessage
     * @param string|null $localeName
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponseFromErrorMessage(
        string $errorMessage,
        ?string $localeName = null,
    ): GlueResponseTransfer {
        /** @var array<\Generated\Shared\Transfer\ErrorTransfer> $errorTransfers */
        $errorTransfers = [(new ErrorTransfer())->setMessage($errorMessage)];

        return $this->createErrorResponse(
            new ArrayObject($errorTransfers),
            $localeName,
        );
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\ErrorTransfer> $errorTransfers
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponse(
        ArrayObject $errorTransfers,
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();

        foreach ($errorTransfers as $errorTransfer) {
            $glueErrorTransfer = $this->createGlueErrorTransfer(
                $errorTransfer,
                $errorTransfer->getMessageOrFail(),
                Response::HTTP_NOT_FOUND
            );

            $glueResponseTransfer->addError($glueErrorTransfer);
        }

        return $this->setGlueResponseHttpStatus($glueResponseTransfer);
    }

    /**
     * @param \ArrayObject $errors
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\GlueErrorTransfer
     */
    protected function createGlueErrorTransfer(
        ErrorTransfer $errorTransfer,
        string $message,
        string $status = Response::HTTP_BAD_REQUEST,
    ): GlueErrorTransfer {
        return (new GlueErrorTransfer())->setStatus($status)
            ->setMessage($message)
            ->fromArray($errorTransfer->getParameters());
    }

    /**
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    protected function setGlueResponseHttpStatus(GlueResponseTransfer $glueResponseTransfer): GlueResponseTransfer
    {
        $glueErrorTransfers = $glueResponseTransfer->getErrors();

        if ($glueErrorTransfers->count() !== 1) {
            return $glueResponseTransfer->setHttpStatus(
                Response::HTTP_MULTI_STATUS,
            );
        }

        $glueErrorTransfer = $glueErrorTransfers->getIterator()->current();

        return $glueResponseTransfer->setHttpStatus(
            $glueErrorTransfer->getStatus(),
        );
    }
}
