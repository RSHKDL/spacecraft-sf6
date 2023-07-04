<?php

namespace App\DataFixtures;

use App\Entity\Defense;
use App\Entity\PowerSupply;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OptionsFixtures extends Fixture implements DependentFixtureInterface
{
    use DataFixturesTrait;

    public function getDependencies(): array
    {
        return [
            ManufacturerFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $options = $this->loadData('components');
            foreach ($options as $key => $mainOption) {
                foreach ($mainOption as $optionData) {
                    switch ($key) {
                        case 'powerSupply':
                            $option = new PowerSupply($optionData['type'], $optionData['name']);
                            $option->setPower($optionData['power'] ?? 0);
                            $option->setStorage($optionData['storage'] ?? 0);
                            break;
                        case 'defense':
                            $option = new Defense($optionData['type'], $optionData['name']);
                            $option->setDefense($optionData['defense']);
                            break;
                        default:
                            throw new \InvalidArgumentException("Unknown option type: $key");
                    }

                    $option->setManufacturer($this->getReference($optionData['manufacturer']));
                    $this->addReference($option->getName(), $option);
                    $manager->persist($option);
                }
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }

}
