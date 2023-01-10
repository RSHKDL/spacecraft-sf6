<?php

namespace App\Entity;

use App\Repository\BlueprintRepository;
use App\Spaceship\SpaceshipInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_blueprint')]
#[ORM\Entity(repositoryClass: BlueprintRepository::class)]
class Blueprint implements SpaceshipInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    private Manufacturer $manufacturer;

    /*#[ORM\ManyToOne(targetEntity: SpaceshipRole::class)]
    private SpaceshipRole $role;

    #[ORM\ManyToOne(targetEntity: SpaceshipClass::class)]
    private SpaceshipClass $class;*/

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /*public function getClass(): SpaceshipClass
    {
        return $this->class;
    }

    public function setClass(SpaceshipClass $class): void
    {
        $this->class = $class;
    }

    public function getRole(): SpaceshipRole
    {
        return $this->role;
    }

    public function setRole(SpaceshipRole $role): void
    {
        $this->role = $role;
    }*/
}
