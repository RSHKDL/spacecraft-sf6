<?php

namespace App\Spaceship\Factory;

use App\Entity\SpaceshipClass;
use App\Spaceship\Model\UsedSpaceshipModel;

final class UsedSpaceshipBuilder
{
    private string $name;
    private string $hullNumber;
    private string $fullClassName;

    public function buildUsedSpaceship(): UsedSpaceshipModel
    {
        return new UsedSpaceshipModel(
            $this->name,
            $this->hullNumber,
            $this->createShipClassification()
        );
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setHullNumber(string $hullNumber): self
    {
        $this->hullNumber = $hullNumber;

        return $this;
    }

    public function setFullClassName(string $fullClassName): self
    {
        $this->fullClassName = $fullClassName;

        return $this;
    }

    private function createShipClassification(): SpaceshipClass
    {
        $parts = explode(' ', $this->fullClassName);
        if (count($parts) > 1) {
            [$variant, $name] = $parts;
        } else {
            [$name] = $parts;
            $variant = null;
        }

        $spaceshipClass = new SpaceshipClass();
        $spaceshipClass->setName($name);
        if ($variant) {
            $spaceshipClass->setVariant($variant);
        }

        return $spaceshipClass;
    }
}