<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository
    ) {
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeRepository->getAntelopeLocation($antelopeLocationCriteriaTransfer);
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessFul(false);
        if ($antelopeLocationTransfer) {
            $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        }
        return $antelopeLocationResponseTransfer;
    }
}
