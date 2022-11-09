<?php

namespace App\Spaceship;

use App\Entity\Manufacturer;

interface SpaceshipInterface
{
    public function getManufacturer(): Manufacturer;
}