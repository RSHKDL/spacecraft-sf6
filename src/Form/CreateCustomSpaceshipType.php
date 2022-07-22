<?php

namespace App\Form;

use App\Model\CustomSpaceship;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCustomSpaceshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name your ship',
                'required' => true,
            ])
            ->add('class', ChoiceType::class, [
                'choices' => $this->getDummyChoices('class'),
                'placeholder' => 'Choose the class',
                'label' => false,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => $this->getDummyChoices('type'),
                'placeholder' => 'Choose the type',
                'label' => false,
            ])
            ->add('model', ChoiceType::class, [
                'choices' => $this->getDummyChoices('model'),
                'placeholder' => 'Choose the model',
                'label' => false,
            ])
            ->add('paintJobs', CollectionType::class, [
                'entry_type' => PaintJobType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomSpaceship::class,
        ]);
    }

    /**
     * Remove when corresponding entities are created
     */
    private function getDummyChoices(string $type): array
    {   $classChoices = ['corvette', 'frigate', 'cruiser', 'battleship'];
        $typeChoices = ['civilian', 'military'];
        $modelChoices = ['factory'];

        return match($type) {
            'class' => array_combine($classChoices, $classChoices),
            'type' => array_combine($typeChoices, $typeChoices),
            'model' => array_combine($modelChoices, $modelChoices),
        };
    }
}