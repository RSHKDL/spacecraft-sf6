<?php

namespace App\Model;

use App\Entity\Manufacturer;
use Doctrine\Common\Collections\ArrayCollection;

final class CustomSpaceship
{
    public Manufacturer $manufacturer;
    public string $class;
    public string $type;
    public string $model;
    public string $name;
    public array $paintJobs;

    public function __construct()
    {
        $this->paintJobs = [];
    }
}