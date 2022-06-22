<?php

namespace App\DataFixtures;

use App\Entity\ProductOptions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductOptionsFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $productOptionsData = $this->loadData("productOptions");
            foreach ($productOptionsData as $datum) {
                $productOptions = new ProductOptions();
                $productOptions->setCode($datum['code']);
                $productOptions->setType($datum['type']);
                $productOptions->setValue($datum['value']);
                if (!empty($datum['context'])) {
                    $productOptions->setContext($datum['context']);
                }

                $productOptions->setProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE));
                $manager->persist($productOptions);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            // log exceptions...
        }
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class
        ];
    }
}