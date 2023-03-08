<?php

namespace App\Entity;

use App\Repository\SpaceshipClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_spaceship_class')]
#[ORM\Entity(repositoryClass: SpaceshipClassRepository::class)]
class SpaceshipClass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 64)]
    private string $name;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $variant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    public function getVariant(): ?string
    {
        return $this->variant;
    }

    public function setVariant(string $variant): void
    {
        $this->variant = $variant;
    }
}
