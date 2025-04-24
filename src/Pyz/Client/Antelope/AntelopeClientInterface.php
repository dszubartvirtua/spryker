<?php

namespace Pyz\Client\Antelope;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopesResponseTransfer;

/**
 * @method \Pyz\Client\Antelope\AntelopeFactory getFactory()
 */
interface AntelopeClientInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer;

    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopesResponseTransfer;
}
