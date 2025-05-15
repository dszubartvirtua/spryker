<?php

namespace Pyz\Zed\AntelopeLocationSearch\Communication\Plugin\Publisher;

use Pyz\Zed\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;


class AntelopeLocationWriterPublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()
            ->writeCollectionByAntelopeLocationEvents($eventEntityTransfers);
    }

    public function getSubscribedEvents(): array
    {
        return [
            AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_CREATE,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE,
        ];
    }
}
