<?php

namespace Unit\Spaceship;

use App\Entity\PowerSupply;
use App\Entity\Spaceship;
use App\Entity\SpaceshipClass;
use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\Model\UsedSpaceshipModel;
use App\Spaceship\SpaceshipConformityInspector;
use PHPUnit\Framework\TestCase;

class SpaceshipConformityInspectorTest extends TestCase
{
    /**
     * Démo: Cas B, incomplet
     * @dataProvider spaceshipAndReactorProvider
     */
//    public function testSpaceshipMustHaveReactor(UsedSpaceshipModel $spaceship, bool $expectedReactorPresence): void
//    {
//        $inspectorService = new SpaceshipConformityInspector();
//
//        $spaceshipHasReactor = $inspectorService->doesSpaceshipHaveReactor($spaceship);
//        self::assertSame($spaceshipHasReactor, $expectedReactorPresence);
//    }
//
//    public function spaceshipAndReactorProvider(): \Generator
//    {
//        $spaceshipWithReactor = new UsedSpaceshipModel(
//            'Rocinante',
//            'xxx',
//            new SpaceshipClass()
//        );
//        $spaceshipWithoutReactor = new UsedSpaceshipModel(
//            'Serenity',
//            'xxx',
//            new SpaceshipClass()
//        );
//
//        $powerSupply = new PowerSupply(PowerSupply::SUBTYPE_REACTOR, 'Fusion reactor');
//        $spaceshipWithReactor->addSpaceshipComponent($powerSupply);
//
//        yield 'A spaceship with a reactor'=> [$spaceshipWithReactor, true];
//        yield 'A spaceship without a reactor'=> [$spaceshipWithoutReactor, false];
//    }

    /**
     * Démo: Cas A
     */
    public function testSpaceshipIsNotSalableByDefault(): void
    {
        $inspectorService = new SpaceshipConformityInspector();
        $usedSpaceship = new UsedSpaceshipModel(
            'Rocinante',
            'xxx',
            new SpaceshipClass()
        );

        self::assertFalse($inspectorService->isSpaceshipSalable($usedSpaceship));
    }

    public function testSpaceshipIsSalableIfConformityInspectionWasApproved(): void
    {
        $inspectorService = new SpaceshipConformityInspector();
        $spaceship = new UsedSpaceshipModel(
            'Serenity',
            'xxx',
            new SpaceshipClass()
        );

        $spaceship->setConformityInspectionStatus(ConformityInspectionStatus::APPROVED);

        self::assertTrue($inspectorService->isSpaceshipSalable($spaceship));
        self::markTestIncomplete();
    }
}