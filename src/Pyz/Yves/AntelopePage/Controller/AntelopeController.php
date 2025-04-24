<?php

namespace Pyz\Yves\AntelopePage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

class AntelopeController extends AbstractController
{
    public function indexAction(): View
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();

        $antelopeResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelopes($antelopeCriteriaTransfer);

        return $this->view(
            ['antelopes' => $antelopeResponseTransfer->getAntelopes()->getArrayCopy()],
            [],
            '@AntelopePage/views/antelope/index.twig'
        );
    }
}
