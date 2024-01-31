<?php

namespace App\DataFixtures;

use App\Manufacturer\Enum\ManufacturerSatisfactionThreshold;
use App\Manufacturer\Factory\ManufacturerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ManufacturerFixtures extends Fixture
{
    use DataFixturesTrait;

    public function __construct(
        private readonly ManufacturerFactory $factory
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $faker = Factory::create();
            $manufacturerData = $this->loadData("manufacturers");
            foreach ($manufacturerData as $data) {
                $manufacturer = ($this->factory->createBuilder())
                    ->createManufacturerNamed($data['name'])
                    ->withStatistics(
                        satisfactionThreshold: $faker->boolean(60) ? ManufacturerSatisfactionThreshold::EXPECTED : ManufacturerSatisfactionThreshold::WARNING,
                        ongoingOrders: $faker->numberBetween(50, 100),
                        averageLeadTime: $faker->numberBetween(150, 360)
                    )
                    ->build();

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
