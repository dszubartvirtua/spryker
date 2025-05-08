<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method AntelopeGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $table = $this->getFactory()->createAntelopeTable();

        return $this->viewResponse([
            'antelopeTable' => $table->render(),
        ]);
    }

    public function tableAction()
    {
        $table = $this->getFactory()->createAntelopeTable();

        return $this->jsonResponse($table->fetchData());
    }
}
