<?php

namespace App\Spaceship\Model;

use App\Entity\MilitaryClassification;
use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\ComponentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class UsedSpaceshipModel
{
    private string $name;
    private string $hullNumber;
    private MilitaryClassification $class;
    private Collection $spaceshipComponents;
    private ConformityInspectionStatus $conformityInspectionStatus;
    public string $slug;

    public function __construct(string $name, string $hullNumber, MilitaryClassification $spaceshipClass)
    {
        $this->name = $name;
        $this->hullNumber = $hullNumber;
        $this->class = $spaceshipClass;
        $this->spaceshipComponents = new ArrayCollection();
        $this->conformityInspectionStatus = ConformityInspectionStatus::INSPECTION_REQUIRED;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHullNumber(): string
    {
        return $this->hullNumber;
    }

    public function getClass(): MilitaryClassification
    {
        return $this->class;
    }

    public function getConformityInspectionStatus(): ConformityInspectionStatus
    {
        return $this->conformityInspectionStatus;
    }

    public function setConformityInspectionStatus(ConformityInspectionStatus $status): void
    {
        $this->conformityInspectionStatus = $status;
    }

    /**
     * @return Collection<int, ComponentInterface>
     */
    public function getSpaceshipComponent(): Collection
    {
        return $this->spaceshipComponents;
    }

    public function addSpaceshipComponent(ComponentInterface $option): void
    {
        if (!$this->spaceshipComponents->contains($option)) {
            $this->spaceshipComponents[] = $option;
        }
    }

    public function removeSpaceshipComponent(ComponentInterface $option): void
    {
        $this->spaceshipComponents->removeElement($option);
    }
}
