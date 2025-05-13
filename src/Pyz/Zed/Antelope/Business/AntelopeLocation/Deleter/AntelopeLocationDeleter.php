<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationDeleter
{
    public function __construct(
        protected readonly AntelopeEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        return $this->antelopeEntityManager->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
