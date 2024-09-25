<?php

namespace App\Entity;

use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\ComponentInterface;
use App\Spaceship\SpaceshipInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_base_spaceship')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'spaceship_type', type: 'string')]
#[ORM\DiscriminatorMap([
    'civilian' => CivilianSpaceship::class,
    'military' => MilitarySpaceship::class,
])]
class Spaceship implements SpaceshipInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'string', length: 18)]
    protected string $hullNumber;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    protected Manufacturer $manufacturer;

    #[ORM\OneToMany(mappedBy: 'spaceship', targetEntity: PaintJob::class)]
    protected Collection $paintJobs;

    #[ORM\OneToMany(mappedBy: 'spaceship', targetEntity: SpaceshipSection::class)]
    protected Collection $sections;

    #[ORM\JoinTable(name: 'app_spaceships_options')]
    #[ORM\JoinColumn(name: 'spaceship_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'option_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: BaseComponent::class, inversedBy: 'spaceships')]
    protected Collection $components;

    protected ConformityInspectionStatus $conformityInspectionStatus = ConformityInspectionStatus::INSPECTION_REQUIRED;

    public function __construct()
    {
        $this->paintJobs = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function getHullNumber(): ?string
    {
        return $this->hullNumber;
    }

    public function setHullNumber(string $number): void
    {
        $this->hullNumber = $number;
    }

    /**
     * @return Collection<int, PaintJob>
     */
    public function getPaintJobs(): Collection
    {
        return $this->paintJobs;
    }

    public function addPaintJob(PaintJob $paintJob): void
    {
        if (!$this->paintJobs->contains($paintJob)) {
            $this->paintJobs[] = $paintJob;
            $paintJob->setSpaceship($this);
        }
    }

    public function removePaintJob(PaintJob $paintJob): void
    {
        // set the owning side to null (unless already changed)
        if ($this->paintJobs->removeElement($paintJob) && $paintJob->getSpaceship() === $this) {
            $paintJob->setSpaceship(null);
        }
    }

    /**
     * @return Collection<int, ComponentInterface>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(ComponentInterface $component): void
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
        }
    }

    public function removeComponent(ComponentInterface $component): void
    {
        $this->components->removeElement($component);
    }

    /**
     * @return Collection<int, SpaceshipSection>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(SpaceshipSection $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setSpaceship($this);
        }

        return $this;
    }

    public function removeSection(SpaceshipSection $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getSpaceship() === $this) {
                $section->setSpaceship(null);
            }
        }

        return $this;
    }

    public function getConformityInspectionStatus(): ConformityInspectionStatus
    {
        return $this->conformityInspectionStatus;
    }

    public function setConformityInspectionStatus(ConformityInspectionStatus $status): void
    {
        $this->conformityInspectionStatus = $status;
    }
}
