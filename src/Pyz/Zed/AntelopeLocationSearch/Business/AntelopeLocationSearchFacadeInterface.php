<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

interface AntelopeLocationSearchFacadeInterface
{
    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void;
}
