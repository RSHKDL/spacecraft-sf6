<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    use DataFixturesTrait;

    public const PRODUCT_REFERENCE = 'product';

    public function load(ObjectManager $manager): void
    {
        try {
            $productsData = $this->loadData("products");
            foreach ($productsData as $productData) {
                $product = new Product();
                $product->setSku($productData['sku']);
                $product->setName($productData['name']);
                $manager->persist($product);
                $this->addReference(self::PRODUCT_REFERENCE, $product);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            // log exceptions...
        }
    }
}
