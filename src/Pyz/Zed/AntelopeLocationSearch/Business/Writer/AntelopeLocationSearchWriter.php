<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business\Writer;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeLocationSearchWriter
{
    protected $eventBehaviorFacade;

    public function __construct(
        EventBehaviorFacadeInterface $eventBehaviorFacade
    ) {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void
    {
        $antelopeIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        $this->writeCollectionByAntelopeLocationIds($antelopeIds);
    }

    protected function writeCollectionByAntelopeLocationIds(array $antelopeLocationIds): void
    {
        if (!$antelopeLocationIds) {
            return;
        }

        // Note: The following code should not be part of the Business Layer because it contains persistence logic.
        // For training purposes we keep this block here to focus on the publish&synchronize process.
        // In an optional exercise you will have the task to move the persistence logic properly into the Persistence Layer.

        foreach ($antelopeLocationIds as $antelopeLocationId) {
            $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
                ->filterByIdAntelopeLocation($antelopeLocationId)
                ->findOne();

            $searchEntity = PyzAntelopeLocationSearchQuery::create()
                ->filterByFkAntelopeLocation($antelopeLocationId)
                ->findOneOrCreate();
            $searchEntity->setFkAntelopeLocation($antelopeLocationId);

            $searchData = $antelopeLocationEntity->toArray();
            $searchEntity->setData($searchData);

            $searchEntity->save();
        }
    }
}
