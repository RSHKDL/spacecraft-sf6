<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_option_power_supply')]
class PowerSupply extends BaseOption
{
    public const TYPE_POWER_SUPPLY = 'power supply';
    public const SUBTYPE_REACTOR = 'reactor';
    public const SUBTYPE_ACCUMULATOR = 'accumulator';

    #[ORM\Column(type: 'integer')]
    private int $power = 0;

    #[ORM\Column(type: 'integer')]
    private int $storage = 0;

    public function getPower(): int
    {
        return $this->power;
    }

    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    public function getStorage(): int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): void
    {
        $this->storage = $storage;
    }
}