<?php

namespace App\Form;

use App\Entity\Defense;
use App\Entity\Manufacturer;
use App\Entity\PowerSupply;
use App\Model\CustomSpaceship;
use App\Repository\BaseOptionRepository;
use App\Spaceship\OptionInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCustomSpaceshipType extends AbstractType
{
    public function __construct(
        private readonly BaseOptionRepository $optionRepository
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /*->add('name', TextType::class, [
                'label' => 'Name your ship',
                'required' => true,
            ])*/
            ->add('manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose the manufacturer',
                'label' => false,
            ])
            ->add('mainRole', ChoiceType::class, [
                'choices' => $this->getDummyChoices('role'),
                'placeholder' => 'Choose the main role',
                'disabled' => true,
                'label' => false,
            ])
            ->add('secondaryRole', ChoiceType::class, [
                'choices' => $this->getDummyChoices('role'),
                'placeholder' => 'Choose the secondary role',
                'disabled' => true,
                'label' => false,
            ])
            ->add('class', ChoiceType::class, [
                'choices' => $this->getDummyChoices('class'),
                'placeholder' => 'Choose the class',
                'disabled' => true,
                'label' => false,
            ])
            ->add('model', ChoiceType::class, [
                'choices' => $this->getDummyChoices('model'),
                'placeholder' => 'Choose the model',
                'disabled' => true,
                'label' => false,
            ])
            ->add('powerSupply', ChoiceType::class, [
                'choices' => $this->optionRepository->findByClass(PowerSupply::class),
                'placeholder' => 'Choose the power supply',
                'choice_value' => 'name',
                'choice_label' => fn (OptionInterface $option) => $option->getName(),
                'label' => false,
                'multiple' => true,
            ])
            ->add('defense', ChoiceType::class, [
                'choices' => $this->optionRepository->findByClass(Defense::class),
                'placeholder' => 'Choose a defense',
                'choice_value' => 'name',
                'choice_label' => fn (OptionInterface $option) => $option->getName(),
                'label' => false,
                'multiple' => true,
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
        $roleChoices = ['civilian', 'military'];
        $modelChoices = ['factory'];

        return match($type) {
            'class' => array_combine($classChoices, $classChoices),
            'role' => array_combine($roleChoices, $roleChoices),
            'model' => array_combine($modelChoices, $modelChoices),
        };
    }
}