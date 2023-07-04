<?php

namespace App\Form;

use App\Entity\Defense;
use App\Entity\Manufacturer;
use App\Entity\PowerSupply;
use App\Model\CustomSpaceship;
use App\Repository\BaseComponentRepository;
use App\Spaceship\ComponentInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Deux cas de figure : soit on a une liste fixe de vaisseau possible à trouver et chaque choix conditionne le
 * suivant (avec la liste complète des vaisseaux en data-attribute, par exemple) soit on permet de créer un vaisseau
 * avec l'ensemble des combinatoires possibles (moins quelques dépendances, exemple de la variante de la coque qui
 * dépend du choix de la coque.
 * @see CreateBlueprintType
 */
class CreateCustomSpaceshipType extends AbstractType
{
    public function __construct(
        private readonly BaseComponentRepository $optionRepository
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
            ->add('role', ChoiceType::class, [
                'choices' => $this->getDummyChoices('role'),
                'placeholder' => 'Choose the main role',
                'disabled' => true,
                'label' => false,
            ])
            ->add('hullClassification', ChoiceType::class, [
                'choices' => $this->getDummyChoices('hullClassification'),
                'placeholder' => 'Choose the hull classification',
                'disabled' => true,
                'label' => false,
            ])
            ->add('hullClassificationVariant', ChoiceType::class, [
                'choices' => $this->getDummyChoices('hullClassificationVariant'),
                'placeholder' => 'Choose the hull classification variant',
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
                'choice_label' => fn (ComponentInterface $option) => $option->getName(),
                'label' => false,
                'multiple' => true,
            ])
            ->add('defense', ChoiceType::class, [
                'choices' => $this->optionRepository->findByClass(Defense::class),
                'placeholder' => 'Choose a defense',
                'choice_value' => 'name',
                'choice_label' => fn (ComponentInterface $option) => $option->getName(),
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
    {
        $roleChoices = ['civilian', 'military'];
        $hullClassificationChoices = ['corvette', 'frigate', 'destroyer', 'cruiser', 'battleship', 'carrier'];
        $hullClassificationVariantChoices = ['todo'];
        $modelChoices = ['factory'];

        return match($type) {
            'role' => array_combine($roleChoices, $roleChoices),
            'hullClassification' => array_combine($hullClassificationChoices, $hullClassificationChoices),
            'hullClassificationVariant' => array_combine($hullClassificationVariantChoices, $hullClassificationVariantChoices),
            'model' => array_combine($modelChoices, $modelChoices),
        };
    }
}
