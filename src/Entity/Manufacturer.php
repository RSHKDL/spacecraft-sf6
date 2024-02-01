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

    #[ORM\OneToOne(mappedBy: 'manufacturer', cascade: ['persist', 'remove'])]
    private ?ManufacturerStatistics $statistics = null;

    /**
     * Not persisted yet, will be replaced by a ManufacturerShipyard collection.
     */
    private int $shipyards = 0;
    private int $assemblyLines = 0;

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

    public function getStatistics(): ?ManufacturerStatistics
    {
        return $this->statistics;
    }

    public function setStatistics(ManufacturerStatistics $statistics): static
    {
        // set the owning side of the relation if necessary
        if ($statistics->getManufacturer() !== $this) {
            $statistics->setManufacturer($this);
        }

        $this->statistics = $statistics;

        return $this;
    }

    public function getShipyards(): int
    {
        return $this->shipyards;
    }

    public function setShipyards(int $shipyards): void
    {
        $this->shipyards = $shipyards;
    }

    public function getAssemblyLines(): int
    {
        return $this->assemblyLines;
    }

    public function setAssemblyLines(int $assemblyLines): void
    {
        $this->assemblyLines = $assemblyLines;
    }
}
