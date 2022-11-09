<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $data = $this->loadData("manufacturers");
            foreach ($data as $datum) {
                $manufacturer = new Manufacturer($datum['name']);

                $manager->persist($manufacturer);
                $this->addReference($manufacturer->getName(), $manufacturer);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}