<?php

namespace Unit\Spaceship;

use App\Entity\CivilianSpaceship;
use App\Entity\MilitarySpaceship;
use App\Spaceship\Factory\SpaceshipBuilder;
use App\Spaceship\Factory\SpaceshipFactory;
use App\Spaceship\Enum\MilitarySpaceshipClassification;
use PHPUnit\Framework\TestCase;

class SpaceshipBuilderTest extends TestCase
{
    private SpaceshipBuilder $builder;

    public function setUp(): void
    {
        $this->builder = (new SpaceShipFactory)->createBuilder();
    }

    public function testCreateBasicMilitarySpaceship(): void
    {
        $spaceship = $this->builder
            ->createMilitarySpaceship(MilitarySpaceshipClassification::FRIGATE, 'stealth')
            ->builtBy('Weyland-Yutani Corporation')
            ->configureBowSection('gunship', [])
//            ->withSections([
//                'bow' => 'gunship',
//                'deck' => 'crew',
//                'stern' => 'gunship',
//                'bridge' => 'frigate cic',
//                'engine' => 'regulated'
//            ])
            ->build()
        ;

        self::assertInstanceOf(MilitarySpaceship::class, $spaceship);
        self::assertEquals('frigate', $spaceship->getClassification()->getName());
        self::assertEquals('stealth', $spaceship->getClassification()->getVariant());
        self::assertEquals('Weyland-Yutani Corporation', $spaceship->getManufacturer()->getName());
    }

    public function testCreateBasicCivilianSpaceship(): void
    {
        $spaceship = $this->builder
            ->createCivilianSpaceship('luxury liner')
            ->build();

        self::assertInstanceOf(CivilianSpaceship::class, $spaceship);
        self::assertEquals('luxury liner', $spaceship->getRole());
    }

}
