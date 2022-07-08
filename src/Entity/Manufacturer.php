<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_manufacturer')]
#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 64)]
    private string $name;

    #[ORM\Column(type: 'string', length: 128)]
    #[Gedmo\Slug(fields: ['name'])]
    private string $slug;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
