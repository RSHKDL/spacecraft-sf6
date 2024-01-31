<?php

namespace App\DataFixtures;

use App\Manufacturer\Enum\ManufacturerSatisfactionThreshold;
use App\Manufacturer\Factory\ManufacturerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

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
            $manufacturerData = $this->loadData("manufacturers");
            foreach ($manufacturerData as $data) {
                $manufacturer = ($this->factory->createBuilder())
                    ->createManufacturerNamed($data['name'])
                    ->withStatistics(
                        satisfactionThreshold: ManufacturerSatisfactionThreshold::EXPECTED,
                        ongoingOrders: 50,
                        averageLeadTime: 189
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
