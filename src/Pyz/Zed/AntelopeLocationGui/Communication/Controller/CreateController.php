<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends AbstractController
{
    protected const URL_ANTELOPE_LOCATION_OVERVIEW = '/antelope-location-gui';
    protected const MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS = 'Location was successfully created.';

    public function indexAction(Request $request)
    {
        $antelopeLocationCreateForm = $this->getFactory()
            ->createAntelopeLocationCreateForm(new AntelopeLocationTransfer())
            ->handleRequest($request);

        if ($antelopeLocationCreateForm->isSubmitted() && $antelopeLocationCreateForm->isValid()) {
            return $this->createAntelopeLocation($antelopeLocationCreateForm);
        }

        return $this->viewResponse([
            'antelopeLocationCreateForm' => $antelopeLocationCreateForm->createView(),
            'backUrl' => $this->getAntelopeLocationOverviewUrl(),
        ]);
    }

    protected function createAntelopeLocation(FormInterface $antelopeLocationCreateForm)
    {
        /** @var \Generated\Shared\Transfer\AntelopeLocationTransfer|null $antelopeLocationTransfer */
        $antelopeLocationTransfer = $antelopeLocationCreateForm->getData();

        $antelopeLocationTransfer = $this->getFactory()
            ->getAntelopeFacade()
            ->createAntelopeLocation($antelopeLocationTransfer);

        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS);

        return $this->redirectResponse($this->getAntelopeLocationOverviewUrl());
    }

    protected function getAntelopeLocationOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_ANTELOPE_LOCATION_OVERVIEW);
    }
}
