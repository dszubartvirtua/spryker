<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
 public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer):?AntelopeTransfer
 {
     $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
         $antelopeCriteriaTransfer->getName(),
     )->joinWithPyzAntelopeLocation()->findOne();
     if(!$antelopeEntity){
         return null;
     }
     return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(), true);
 }

    public function getAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer):?AntelopeLocationTransfer
    {
        $antelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()->findByIdLocation(
            $antelopeLocationCriteriaTransfer->getIdLocation(),
        )->findOne();
        if(!$antelopeLocationEntity){
            return null;
        }
        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(), true);
    }

    public function getAntelopeLocations(AntelopeLocationsCriteriaTransfer|\Generated\Shared\Transfer\AntelopeLocationsCriteriaTransfer $antelopeLocationsCriteriaTransfer):?array
    {
        $antelopeLocationCollection = $this->getFactory()->createAntelopeLocationQuery()->find();
        if(!$antelopeLocationCollection){
            return null;
        }
        $result = [];
        foreach ($antelopeLocationCollection as $antelopeLocationEntity) {
            $result[] = (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(), true);
        }

        return $result;
    }
}
