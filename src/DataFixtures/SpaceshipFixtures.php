<?php

namespace App\DataFixtures;

use App\Entity\Spaceship;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpaceshipFixtures extends Fixture implements DependentFixtureInterface
{
    use DataFixturesTrait;

    public function getDependencies(): array
    {
        return [
            ManufacturerFixtures::class,
            OptionsFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $spaceshipsData = $this->loadData("spaceships");
            foreach ($spaceshipsData as $datum) {
                $spaceship = new Spaceship();
                $spaceship->setManufacturer($this->getReference($datum['manufacturer']));

                $manager->persist($spaceship);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}