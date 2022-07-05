<?php

namespace App\DataFixtures;

use App\Entity\Color;
use App\Entity\Spaceship;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpaceshipFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $spaceshipsData = $this->loadData("spaceships");
            foreach ($spaceshipsData as $datum) {
                $spaceship = new Spaceship($datum['hullNumber']);
                $spaceship->setManufacturer($datum['manufacturer']);
                $spaceship->setClass($datum['class']);
                $spaceship->setType($datum['type']);
                $spaceship->setModel($datum['model']);

                $manager->persist($spaceship);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}