<?php

namespace App\Spaceship\Factory;

class SpaceshipFactory
{
    public function createBuilder(): SpaceshipBuilder
    {
        return new SpaceshipBuilder();
    }
}
