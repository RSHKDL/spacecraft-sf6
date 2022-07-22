<?php

namespace App\Form;

use App\Entity\PaintJob;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaintJobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region', ChoiceType::class, [
                'choices' => [
                    'Keel' => 'keel',
                    'Bow' => 'bow',
                    'Stern' => 'stern',
                    'Port side Hull' => 'port-side-hull',
                    'Starboard side Hull' => 'starboard-side-hull'
                ],
                'placeholder' => 'Choose a region',
                'label' => false
            ])
            ->add('color')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaintJob::class,
        ]);
    }
}