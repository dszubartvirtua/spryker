<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeTransfer);
    }

    public function getAntelopeLocationById(
        int $idLocation,
    ): ?AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationById($idLocation);
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $criteriaTransfer,
    ): AntelopeResponseTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelope($criteriaTransfer);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $criteriaTransfer,
    ): AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($criteriaTransfer);
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $criteriaTransfer,
    ): AntelopeLocationResponseTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocation($criteriaTransfer);
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $criteriaTransfer): AntelopeLocationCollectionTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationCollection(
            $criteriaTransfer,
        );
    }

    public function getAntelopeCollection(AntelopeCriteriaTransfer $criteriaTransfer): AntelopeCollectionTransfer
    {
        return $this->getFactory()->createAntelopeReader()->getAntelopeCollection($criteriaTransfer);
    }

    public function getAntelopeLocations(): AntelopeLocationCollectionTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocations();
    }

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelopeLocation($antelopeLocationTransfer);
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        return $this->getFactory()->createAntelopeLocationDeleter()->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
