<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_color')]
#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 64)]
    private string $name;

    #[ORM\Column(type: 'string', length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private string $code;

    #[ORM\Column(type: 'integer')]
    private int $red;

    #[ORM\Column(type: 'integer')]
    private int $green;

    #[ORM\Column(type: 'integer')]
    private int $blue;

    public function __construct(string $name, int $red, int $green, int $blue)
    {
        $this->name = $name;
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getRed(): ?int
    {
        return $this->red;
    }

    public function getGreen(): ?int
    {
        return $this->green;
    }

    public function getBlue(): ?int
    {
        return $this->blue;
    }
}
