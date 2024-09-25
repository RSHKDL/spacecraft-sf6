<?php

namespace App\Spaceship\Factory;

use App\Entity\CivilianSpaceship;
use App\Entity\Manufacturer;
use App\Entity\MilitarySpaceship;
use App\Entity\MilitaryClassification;
use App\Entity\SpaceshipSection;
use App\Spaceship\Enum\MilitarySpaceshipClassification;
use App\Spaceship\SpaceshipInterface;

class SpaceshipBuilder
{
    private SpaceshipInterface $spaceship;

    public function build(): SpaceshipInterface
    {
        return $this->spaceship;
    }

    public function createCivilianSpaceship(string $role): self
    {
        $this->spaceship = new CivilianSpaceship();
        $this->spaceship->setRole($role);

        return $this;
    }

    public function createMilitarySpaceship(
        MilitarySpaceshipClassification $class,
        ?string $subclass = null
    ): self
    {
        $this->spaceship = new MilitarySpaceship();
        $classification = new MilitaryClassification($class->value, $subclass);
        $this->spaceship->setClassification($classification);

        return $this;
    }

    public function builtBy(string $manufacturerName): self
    {
        $manufacturer = new Manufacturer($manufacturerName);
        $this->spaceship->setManufacturer($manufacturer);

        return $this;
    }

    public function configureBowSection(string $type, array $components): self
    {
        $section = new SpaceshipSection('bow', $type);
        //$this->spaceship->addSection($section);

        return $this;
    }

    private function addClassification(string $class, ?string $subclass = null)
    {

    }
}
