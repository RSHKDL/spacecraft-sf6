<?php

namespace App\DataFixtures;

use App\Entity\ProductOption;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductOptionFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $productOptionData = $this->loadData("productOption");
            foreach ($productOptionData as $datum) {
                $productOption = new ProductOption();
                $productOption->setCode($datum['code']);
                $productOption->setType($datum['type']);
                $productOption->setValue($datum['value']);
                if (!empty($datum['context'])) {
                    $productOption->setContext($datum['context']);
                }

                $this->addReference($datum['code'], $productOption);
                $manager->persist($productOption);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            // log exceptions...
        }
    }
}