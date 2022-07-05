<?php

namespace App\Entity;

use App\Repository\SpaceshipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_spaceship')]
#[ORM\Entity(repositoryClass: SpaceshipRepository::class)]
class Spaceship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $manufacturer;

    #[ORM\Column(type: 'string', length: 18)]
    private string $hullNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private string $class;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\Column(type: 'string', length: 255)]
    private string $model;

    public function __construct(string $hullNumber)
    {
        $this->hullNumber = $hullNumber;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getHullNumber(): ?string
    {
        return $this->hullNumber;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }
}
