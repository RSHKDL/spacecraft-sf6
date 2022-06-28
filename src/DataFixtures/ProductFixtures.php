<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    use DataFixturesTrait;

    public function getDependencies(): array
    {
        return [
            ProductOptionFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $productsData = $this->loadData("products");
            foreach ($productsData as $datum) {
                $product = new Product();
                $product->setSku($datum['sku']);
                $product->setName($datum['name']);

                if (!empty($datum['options'])) {
                    foreach ($datum['options'] as $option) {
                        $product->addOption($this->getReference($option));
                    }
                }

                $manager->persist($product);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            // log exceptions...
        }
    }
}
