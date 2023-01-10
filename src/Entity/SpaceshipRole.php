<?php

namespace App\Entity;

use App\Repository\SpaceshipRoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_spaceship_role')]
#[ORM\Entity(repositoryClass: SpaceshipRoleRepository::class)]
class SpaceshipRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 64)]
    private string $name;

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
}
