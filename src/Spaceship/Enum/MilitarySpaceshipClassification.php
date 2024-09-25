<?php

namespace App\Spaceship\Enum;

enum MilitarySpaceshipClassification: string
{
    case CORVETTE = 'corvette';
    case FRIGATE = 'frigate';
    case DESTROYER = 'destroyer';
    case CRUISER = 'cruiser';
    case BATTLESHIP = 'battleship';
}
