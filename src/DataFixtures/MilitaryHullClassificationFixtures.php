<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\SpaceshipClass;
use App\Entity\SpaceshipRole;
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
                        $spaceshipClass = new SpaceshipClass();
                        $spaceshipClass->setName($datum['name']);
                        $spaceshipClass->setAlias($datum['alias'] ?? null);
                        $spaceshipClass->setVariant($variant);
                        $manager->persist($spaceshipClass);
                        $referenceName = $spaceshipClass->getName() . ' ' . $spaceshipClass->getVariant();
                        $this->addReference($referenceName, $spaceshipClass);
                    }
                }

                $spaceshipClass = new SpaceshipClass();
                $spaceshipClass->setName($datum['name']);
                $spaceshipClass->setAlias($datum['alias'] ?? null);
                $manager->persist($spaceshipClass);
                $this->addReference($spaceshipClass->getName(), $spaceshipClass);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}