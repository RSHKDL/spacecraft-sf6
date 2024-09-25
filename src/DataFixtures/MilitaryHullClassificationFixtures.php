<?php

namespace App\DataFixtures;

use App\Entity\MilitaryClassification;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MilitaryHullClassificationFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $data = $this->loadData('militaryHullClassification');
            foreach ($data as $datum) {
                if (isset($datum['variants'])) {
                    foreach ($datum['variants'] as $variant) {
                        $militaryClassification = new MilitaryClassification($datum['name'], $variant);
                        $militaryClassification->setAlias($datum['alias'] ?? null);

                        $manager->persist($militaryClassification);
                        $referenceName = $militaryClassification->getName() . ' ' . $militaryClassification->getVariant();
                        $this->addReference($referenceName, $militaryClassification);
                    }
                }

                $militaryClassification = new MilitaryClassification($datum['name']);
                $militaryClassification->setAlias($datum['alias'] ?? null);
                $manager->persist($militaryClassification);
                $this->addReference($militaryClassification->getName(), $militaryClassification);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}
