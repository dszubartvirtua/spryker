<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements
    AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer
    {
        $antelopeEntity = new PyzAntelopeLocation();

        $antelopeEntity->fromArray($antelopeLocationTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeLocationTransfer->fromArray(
            $antelopeEntity->toArray(),
            true,
        );
    }

    /**
     * @throws PropelException
     * @throws AmbiguousComparisonException
     */
    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $antelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())->findOne();
        if (!$antelopeLocationEntity) {
            throw new \Exception('AntelopeLocation not found');
        }
        $mapper = $this->getFactory()->createAntelopeLocationMapper();
        $antelopeLocationEntity = $mapper->mapAntelopeLocationTransferToEntity($antelopeLocationTransfer,
            $antelopeLocationEntity);
        $antelopeLocationEntity->save();
        return $mapper->mapAntelopeLocationEntityToTransfer($antelopeLocationEntity, $antelopeLocationTransfer);
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        return (bool) $this->getFactory()->createAntelopeLocationQuery()->filterByPrimaryKey(
            $antelopeLocationTransfer->getIdAntelopeLocation(),
        )->delete();
    }
}
