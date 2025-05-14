<?php

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
            ->filterByLocationName($dataSet['name'])
            ->findOneOrCreate();

        if ($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()) {
            $antelopeLocationEntity->save();
        }
    }
}
