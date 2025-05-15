<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;


use Spryker\Zed\Kernel\Business\AbstractFacade;

class AntelopeLocationSearchFacade extends AbstractFacade implements AntelopeLocationSearchFacadeInterface
{
    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void
    {
        $this->getFactory()
            ->createAntelopeLocationSearchWriter()
            ->writeCollectionByAntelopeLocationEvents($eventTransfers);
    }
}
