<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_civilian_spaceship')]
class CivilianSpaceship extends Spaceship
{
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
