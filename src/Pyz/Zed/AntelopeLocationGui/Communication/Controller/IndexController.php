<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->viewResponse([
            'antelopeLocationTable' => $table->render(),
        ]);
    }

    public function tableAction()
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->jsonResponse($table->fetchData());
    }
}
