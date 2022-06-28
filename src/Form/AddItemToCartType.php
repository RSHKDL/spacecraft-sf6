<?php

namespace App\Form;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\ProductOption;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddItemToCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $product = $options['product'];
        $productOptions = $options['productOptions'];

        $builder->setData(new CartItem($product));
        $builder
            ->add('color', EntityType::class, [
                'class' => ProductOption::class,
                'choices' => $productOptions,
                'placeholder' => 'Color',
                'choice_label' => 'value',
            ])
            ->add('quantity', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['product', 'productOptions']);
        $resolver->addAllowedTypes('product', Product::class);
        $resolver->addAllowedTypes('productOptions', 'array');
        $resolver->setDefaults([
            'data_class' => CartItem::class,
        ]);
    }
}
