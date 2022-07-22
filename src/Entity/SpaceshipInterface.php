<?php

namespace App\Entity;

use App\Entity\Manufacturer;

interface SpaceshipInterface
{
    public function getManufacturer(): Manufacturer;
}