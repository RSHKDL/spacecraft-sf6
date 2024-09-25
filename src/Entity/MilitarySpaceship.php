<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_military_spaceship')]
class MilitarySpaceship extends Spaceship
{
    #[ORM\ManyToOne(inversedBy: 'militarySpaceships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MilitaryClassification $classification = null;

    public function getClassification(): ?MilitaryClassification
    {
        return $this->classification;
    }

    public function setClassification(?MilitaryClassification $classification): void
    {
        $this->classification = $classification;
    }
}
