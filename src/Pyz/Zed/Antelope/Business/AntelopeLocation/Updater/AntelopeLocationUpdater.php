<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Updater;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;

class AntelopeLocationUpdater
{
    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->entityManager->updateAntelopeLocation($antelopeLocationTransfer);
    }
}
