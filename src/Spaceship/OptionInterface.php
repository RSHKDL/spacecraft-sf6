<?php

namespace App\Spaceship;

interface OptionInterface
{
    public function getType(): string;
    public function getSubtype(): string;
}