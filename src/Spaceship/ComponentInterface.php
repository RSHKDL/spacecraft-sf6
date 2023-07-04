<?php

namespace App\Spaceship;

interface ComponentInterface
{
    public function getType(): string;
    public function getSubtype(): string;
}
