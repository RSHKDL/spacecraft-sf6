<?php

namespace App\Spaceship\Model;

use App\Entity\SpaceshipClass;
use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\SpaceshipConformityInspector;

final class UsedSpaceshipModel
{

    public string $name;
    public string $hullNumber;
    public SpaceshipClass $class;
    //public ConformityInspectionStatus $conformityInspectionStatus;
    //public bool $isSalable;

    public function __construct(string $name, string $hullNumber, SpaceshipClass $spaceshipClass)
    {
        $this->name = $name;
        $this->hullNumber = $hullNumber;
        $this->class = $spaceshipClass;
    }
}