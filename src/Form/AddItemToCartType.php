<?php

namespace App\Form;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\ProductOption;
use http\Exception\InvalidArgumentException;
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
        if (!$product instanceof Product) {
            throw new InvalidArgumentException();
        }

        $optionsTypes = $options['optionsTypes'];

        $builder->setData(new CartItem($product));

        foreach ($optionsTypes as $type) {
            $builder->add("option_{$type}", EntityType::class, [
                'class' => ProductOption::class,
                'choices' => $product->getOptionsByType($type),
                'placeholder' => "app.product.form.placeholder.{$type}",
                'choice_label' => 'value',
                'mapped' => false
            ]);
        }

        $builder->add('quantity', IntegerType::class);
        $builder->add('options');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['product', 'optionsTypes']);
        $resolver->addAllowedTypes('product', Product::class);
        $resolver->addAllowedTypes('optionsTypes', 'array');
        $resolver->setDefaults([
            'data_class' => CartItem::class,
        ]);
    }
}
