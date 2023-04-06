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
        $model = new UsedSpaceshipModel(
            $this->name,
            $this->hullNumber,
            $this->createShipClassification()
        );

        $this->generateAndSetSlug($model);

        return $model;
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

    public function generateAndSetSlug(UsedSpaceshipModel $model): self
    {
        $model->slug = mb_strtolower($this->name);

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