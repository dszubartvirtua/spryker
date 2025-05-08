<?php

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    public const COL_ID = 'id_antelope';
    public const COL_NAME = 'name';
    public const COL_ID_LOCATION = 'location_name';

    public function __construct(private readonly PyzAntelopeQuery $antelopeQuery)
    {
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            PyzAntelopeTableMap::COL_ID_ANTELOPE => 'Antelope ID',
            PyzAntelopeTableMap::COL_NAME => 'Name',
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME => 'Location',
        ]);

        $config->setSortable([
            PyzAntelopeTableMap::COL_ID_ANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME
        ]);

        $config->setSearchable([
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $antelopeEntityCollection = $this->runQuery(
            $this->antelopeQuery->joinWithPyzAntelopeLocation(),
            $config,
            true
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    protected function mapReturns(ObjectCollection $antelopeEntityCollection): array
    {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $location = $antelopeEntity->getPyzAntelopeLocation();
            $data = [];
            $data[PyzAntelopeTableMap::COL_ID_ANTELOPE] = $antelopeEntity->getIdAntelope();
            $data[PyzAntelopeTableMap::COL_NAME] = $antelopeEntity->getName();
            $data[PyzAntelopeLocationTableMap::COL_LOCATION_NAME] = $location->getLocationName();
            $returns[] = $data;
        }

        return $returns;
    }
}
