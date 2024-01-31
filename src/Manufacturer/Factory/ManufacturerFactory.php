<?php

namespace App\Manufacturer\Factory;

class ManufacturerFactory
{
    public function createBuilder(): ManufacturerBuilder
    {
        return new ManufacturerBuilder();
    }
}
