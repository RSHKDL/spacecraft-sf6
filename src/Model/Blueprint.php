<?php

namespace App\Model;

use App\Entity\Manufacturer;

final class Blueprint
{
    public Manufacturer $manufacturer;
    public string $role;
    public string $class;
    public string $variant;
    public string $model;
}