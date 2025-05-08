<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeLocationTable extends AbstractTable
{
    public const COL_ID_LOCATION = 'id_location';
    public const COL_NAME = 'location_name';

    public function __construct(private readonly PyzAntelopeLocationQuery $antelopeLocationQuery)
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
            static::COL_ID_LOCATION => 'Location ID',
            static::COL_NAME => 'Name',
        ]);

        $config->setSortable([
            static::COL_ID_LOCATION,
            static::COL_NAME,
        ]);

        $config->setSearchable([
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
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
        $antelopeLocationEntityCollection = $this->runQuery(
            $this->antelopeLocationQuery,
            $config,
            true
        );

        if (!$antelopeLocationEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeLocationEntityCollection);
    }

    protected function mapReturns(ObjectCollection $antelopeEntityCollection): array
    {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeLocationEntity) {
            $returns[] = $antelopeLocationEntity->toArray();
        }

        return $returns;
    }
}
