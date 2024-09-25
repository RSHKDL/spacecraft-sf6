<?php

namespace Unit\Manufacturer;

use App\Entity\Manufacturer;
use App\Manufacturer\Enum\ManufacturerSatisfactionThreshold;
use App\Manufacturer\Factory\ManufacturerFactory;
use App\Manufacturer\Ranking\RankingGenerator;
use PHPUnit\Framework\TestCase;

class ManufacturerRankingTest extends TestCase
{
    /**
     * @dataProvider manufacturerDataProvider
     */
    public function testInitial(array $manufacturers): void
    {
        $rankingGenerator = new RankingGenerator();
        $this->markTestIncomplete('todo');
    }

    public function manufacturerDataProvider(): \Generator
    {
        $factory = new ManufacturerFactory();

        $manufacturerExpected = ($factory->createBuilder())
            ->createManufacturerNamed('A')
            ->withStatistics(ManufacturerSatisfactionThreshold::EXPECTED, 0, 0)
            ->build();

        $manufacturerWarning = ($factory->createBuilder())
            ->createManufacturerNamed('B')
            ->withStatistics(ManufacturerSatisfactionThreshold::WARNING, 0, 0)
            ->build();

        $manufacturerCritical= ($factory->createBuilder())
            ->createManufacturerNamed('C')
            ->withStatistics(ManufacturerSatisfactionThreshold::ALERT, 0, 0)
            ->build();

        yield 'Case1' => [
            [
                $manufacturerExpected,
                $manufacturerWarning,
                $manufacturerCritical
            ],
        ];
//        yield 'Case2' => [
//            [
//                $manufacturerExpected,
//                $manufacturerWarning,
//                $manufacturerCritical
//            ],
//        ];
//        yield 'Case3' => [
//            [
//                $manufacturerExpected,
//                $manufacturerWarning,
//                $manufacturerCritical
//            ],
//        ];
    }
}
