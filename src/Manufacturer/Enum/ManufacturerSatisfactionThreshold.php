<?php

namespace App\Manufacturer\Enum;

enum ManufacturerSatisfactionThreshold: string
{
    case EXPECTED = 'expected_threshold';
    case WARNING = 'warning_threshold';
    case ALERT = 'alert_threshold';
    case MISSING = 'missing_data';
 }
