<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Generated\Shared\Transfer\AntelopeLocationsCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationsResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    public const FIELD_NAME = 'name';
    public const FIELD_ID_LOCATION = 'id_location';

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addNameField($builder);
        $this->addLocationField($builder);
    }

    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => 'Name',
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    protected function addLocationField(FormBuilderInterface $builder): static
    {
        /** @var AntelopeLocationsResponseTransfer $antelopeLocations */
        $antelopeLocations = $this->getFactory()->getAntelopeFacade()->getAntelopeLocations(new AntelopeLocationsCriteriaTransfer());
        $builder->add(static::FIELD_ID_LOCATION, ChoiceType::class, [
            'choices' => $this->getLocationChoices($antelopeLocations->getAntelopeLocations()->getArrayCopy()),
            'required' => false,
            'multiple' => false,
            'label' => 'Location',
        ]);

        return $this;
    }

    protected function getLocationChoices(array $locations): array
    {
        $choices = [];

        foreach ($locations as $location) {
            $choices[$location->getLocationName()] = $location->getIdLocation();
        }

        return $choices;
    }
}
