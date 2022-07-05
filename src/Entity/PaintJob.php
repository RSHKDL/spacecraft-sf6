<?php

namespace App\Entity;

use App\Repository\PaintJobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_paint_job')]
#[ORM\Entity(repositoryClass: PaintJobRepository::class)]
class PaintJob
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $region;

    #[ORM\ManyToOne(targetEntity: Spaceship::class, inversedBy: 'paintJobs')]
    private Spaceship $spaceship;

    #[ORM\ManyToOne(targetEntity: Color::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Color $color;

    public function __construct(string $region, Spaceship $spaceship, Color $color)
    {
        $this->region = $region;
        $this->spaceship = $spaceship;
        $this->color = $color;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getSpaceship(): Spaceship
    {
        return $this->spaceship;
    }

    public function setSpaceship(?Spaceship $spaceship): void
    {
        $this->spaceship = $spaceship;
    }

    public function getColor(): Color
    {
        return $this->color;
    }
}
