<?php

namespace App\Form;

use App\Entity\Manufacturer;
use App\Entity\SpaceshipClass;
use App\Entity\SpaceshipRole;
use App\Model\Blueprint as BlueprintModel;
use Doctrine\ORM\EntityManagerInterface;
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
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dd($this->entityManager->getRepository(Manufacturer::class)->findAll());
        /*
         * Note : If all variance axis are VarianceAxis just loop over an array of VarianceAxis
         */
        $builder
            ->add('manufacturer', ChoiceType::class, [
                'choices' => [],
                'placeholder' => 'Choose the manufacturer',
                'label' => false,
                'attr' => [
                    'class' => 'js-select-node',
                    'data-select-type' => 'manufacturer',
                    'data-select-mode' => 'basic'
                ]
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [],
                'placeholder' => 'Choose the main role',
                'label' => false,
                'attr' => [
                    'class' => 'js-select-node',
                    'data-select-type' => 'role',
                    'data-select-mode' => 'basic'
                ]
            ])
            ->add('className', ChoiceType::class, [
                'choices' => [],
                'placeholder' => 'Choose the hull classification',
                'label' => false,
                'attr' => [
                    'class' => 'js-select-node',
                    'data-select-type' => 'className',
                    'data-select-mode' => 'combinatorial'
                ]
            ])
            ->add('classVariant', ChoiceType::class, [
                'choices' => [],
                'placeholder' => 'Choose the hull classification variant',
                'label' => false,
                'attr' => [
                    'class' => 'js-select-node',
                    'data-select-type' => 'classVariant',
                    'data-select-mode' => 'combinatorial'
                ]
            ])
        ;

        // Resetting the view transformer allow any values to be processed by a ChoiceType which is very useful in our case
        $builder->get('manufacturer')->resetViewTransformers();
        $builder->get('role')->resetViewTransformers();
        $builder->get('className')->resetViewTransformers();
        $builder->get('classVariant')->resetViewTransformers();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlueprintModel::class,
            'validation_groups' => false
        ]);
    }
}