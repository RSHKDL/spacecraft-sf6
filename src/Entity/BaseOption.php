<?php

namespace App\Entity;

use App\Spaceship\OptionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'app_option_base')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'option_type', type: 'string')]
#[ORM\DiscriminatorMap([
    'power_supply' => PowerSupply::class,
    'defense' => Defense::class,
])]
class BaseOption implements OptionInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $type;

    #[ORM\Column(type: 'string', length: 255)]
    #[Gedmo\Slug(fields: ['name'])]
    protected string $identifier;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $name;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    protected Manufacturer $manufacturer;

    #[ORM\ManyToMany(targetEntity: Spaceship::class, mappedBy: 'options')]
    private Collection $spaceships;

    public function __construct(string $subtype, string $name)
    {
        $this->type = $subtype;
        $this->name = $name;
        $this->spaceships = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getSubtype(): string
    {
        return $this->type;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return Collection<int, Spaceship>
     */
    public function getSpaceships(): Collection
    {
        return $this->spaceships;
    }

    public function addSpaceship(Spaceship $spaceship): void
    {
        if (!$this->spaceships->contains($spaceship)) {
            $this->spaceships[] = $spaceship;
            $spaceship->addOption($this);
        }
    }

    public function removeSpaceship(Spaceship $spaceship): void
    {
        if ($this->spaceships->removeElement($spaceship)) {
            $spaceship->removeOption($this);
        }
    }
}