<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $colorsData = $this->loadData("colors");
            foreach ($colorsData as $datum) {
                $color = new Color(
                    $datum['name'],
                    $datum['red'],
                    $datum['green'],
                    $datum['blue']
                );

                $manager->persist($color);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}