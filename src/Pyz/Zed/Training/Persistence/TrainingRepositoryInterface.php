<?php

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface TrainingRepositoryInterface
{
    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeTransfer;
}
