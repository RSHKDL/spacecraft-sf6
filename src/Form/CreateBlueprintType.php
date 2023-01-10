<?php

namespace App\Form;

use App\Entity\Manufacturer;
use App\Model\Blueprint;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Deux cas de figure : soit on a une liste fixe de vaisseau possible à trouver et chaque choix conditionne le
 * suivant (avec la liste complète des vaisseaux en data-attribute, par exemple) soit on permet de créer un vaisseau
 * avec l'ensemble des combinatoires possibles (moins quelques dépendances, exemple de la variante de la coque qui
 * dépend du choix de la coque.
 * @see CreateBaseSpaceshipType
 */
class CreateBlueprintType extends AbstractType
{
    public function __construct() {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose the manufacturer',
                'label' => false,
            ])
            ->add('role', ChoiceType::class, [
                'choices' => $this->getDummyChoices('role'),
                'placeholder' => 'Choose the main role',
                'label' => false,
            ])
            ->add('class', ChoiceType::class, [
                'choices' => $this->getDummyChoices('hullClassification'),
                'placeholder' => 'Choose the hull classification',
                'label' => false,
            ])
            ->add('variant', ChoiceType::class, [
                'choices' => $this->getDummyChoices('hullClassificationVariant'),
                'placeholder' => 'Choose the hull classification variant',
                'label' => false,
            ])
            ->add('model', ChoiceType::class, [
                'choices' => $this->getDummyChoices('model'),
                'placeholder' => 'Choose the model',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blueprint::class,
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