<?php

namespace App\Entity;

use App\Repository\MilitaryClassificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MilitaryClassification::class)]
#[ORM\Table(name: 'app_military_classification')]
class MilitaryClassification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 64)]
    private string $name;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $variant;

    #[ORM\OneToMany(mappedBy: 'classification', targetEntity: MilitarySpaceship::class, orphanRemoval: true)]
    private Collection $militarySpaceships;

    public function __construct(string $name, ?string $variant = null)
    {
        $this->name = $name;
        $this->variant = $variant;
        $this->militarySpaceships = new ArrayCollection();
    }

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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    public function getVariant(): ?string
    {
        return $this->variant;
    }

    public function setVariant(string $variant): void
    {
        $this->variant = $variant;
    }

    /**
     * @return Collection<int, MilitarySpaceship>
     */
    public function getMilitarySpaceships(): Collection
    {
        return $this->militarySpaceships;
    }

    public function addMilitarySpaceship(MilitarySpaceship $militarySpaceship): static
    {
        if (!$this->militarySpaceships->contains($militarySpaceship)) {
            $this->militarySpaceships->add($militarySpaceship);
            $militarySpaceship->setClassification($this);
        }

        return $this;
    }

    public function removeMilitarySpaceship(MilitarySpaceship $militarySpaceship): static
    {
        if ($this->militarySpaceships->removeElement($militarySpaceship)) {
            // set the owning side to null (unless already changed)
            if ($militarySpaceship->getClassification() === $this) {
                $militarySpaceship->setClassification(null);
            }
        }

        return $this;
    }
}
