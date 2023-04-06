<?php

namespace App\Spaceship;

use App\Entity\PowerSupply;
use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\Model\UsedSpaceshipModel;

final class SpaceshipConformityInspector
{
    public function doesSpaceshipHaveReactor(UsedSpaceshipModel $spaceship): bool
    {
        return $spaceship->getSpaceshipComponent()->exists(static function ($key, $component) {
            return $component->getSubType() === PowerSupply::SUBTYPE_REACTOR;
        });
    }

    public function isSpaceshipSalable(UsedSpaceshipModel $spaceship): bool
    {
        return $spaceship->getConformityInspectionStatus() === ConformityInspectionStatus::APPROVED;
    }
}