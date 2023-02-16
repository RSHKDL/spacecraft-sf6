<?php

namespace App\DataFixtures;

use App\Entity\Blueprint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MilitaryBlueprintFixtures extends Fixture implements DependentFixtureInterface
{
    use DataFixturesTrait;

    public function getDependencies(): array
    {
        return [
            ManufacturerFixtures::class,
            RoleFixtures::class,
            MilitaryHullClassificationFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $data = $this->loadData('militaryBlueprint');
            foreach ($data as $datum) {
                $blueprint = new Blueprint();
                $blueprint->setManufacturer($this->getReference($datum['manufacturer']));
                $blueprint->setRole($this->getReference('military'));
                $reference = $datum['class'];
                if (null !== $datum['variant']) {
                    $reference .= ' ' . $datum['variant'];
                }
                $blueprint->setClass($this->getReference($reference));
                $manager->persist($blueprint);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}