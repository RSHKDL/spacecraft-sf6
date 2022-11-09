<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_option_defense')]
class Defense extends BaseOption
{
    public const TYPE_DEFENSE = 'defense';
    public const SUBTYPE_SHIELD = 'shield';
    public const SUBTYPE_ARMOR = 'armor';

    #[ORM\Column(type: 'integer')]
    private int $defense = 1;

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): void
    {
        $this->defense = $defense;
    }
}