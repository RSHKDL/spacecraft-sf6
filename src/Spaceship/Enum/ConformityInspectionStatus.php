<?php

namespace App\Spaceship\Enum;

enum ConformityInspectionStatus: string
{
    case INSPECTION_REQUIRED = 'inspection_required';
    case INSPECTION_ONGOING = 'inspection_ongoing';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
