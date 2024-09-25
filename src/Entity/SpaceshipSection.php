<?php

namespace App\Entity;

use App\Repository\SpaceshipSectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpaceshipSectionRepository::class)]
#[ORM\Table(name: 'app_spaceship_section')]
class SpaceshipSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spaceship $spaceship = null;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSpaceship(): ?Spaceship
    {
        return $this->spaceship;
    }

    public function setSpaceship(?Spaceship $spaceship): static
    {
        $this->spaceship = $spaceship;

        return $this;
    }
}
