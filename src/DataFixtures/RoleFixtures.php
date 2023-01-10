<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\SpaceshipRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $data = $this->loadData("roles");
            foreach ($data as $datum) {
                $role = new SpaceshipRole();
                $role->setName($datum['role']);

                $manager->persist($role);
                $this->addReference($role->getName(), $role);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}