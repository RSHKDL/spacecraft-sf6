<?php

namespace App\Spaceship\Model;
use App\Spaceship\Enum\ConformityInspectionStatus;

final class ConformityInspectionReport
{
    public string $spaceshipName;
    public ?ConformityInspectionStatus $status;
    public \DateTime $reportDate;
    public ?string $errorMessage = null;
}