<?php

namespace App\Model;

use App\Entity\Manufacturer;

final class CustomSpaceship
{
    public Manufacturer $manufacturer;
    public string $class;
    public string $type;
    public string $model;
    public string $name;
    public array $paintJobs = [];
}