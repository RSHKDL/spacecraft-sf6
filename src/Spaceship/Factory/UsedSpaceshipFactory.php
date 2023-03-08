<?php

namespace App\Spaceship\Factory;

class UsedSpaceshipFactory
{
    public function createBuilder(): UsedSpaceshipBuilder
    {
        return new UsedSpaceshipBuilder();
    }
}