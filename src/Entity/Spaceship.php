<?php

namespace App\Entity;

use App\Repository\SpaceshipRepository;
use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\ComponentInterface;
use App\Spaceship\SpaceshipInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_spaceship')]
#[ORM\Entity(repositoryClass: SpaceshipRepository::class)]
class Spaceship implements SpaceshipInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 18)]
    private string $hullNumber;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    private Manufacturer $manufacturer;

    private SpaceshipClass $class;

    #[ORM\OneToMany(mappedBy: 'spaceship', targetEntity: PaintJob::class)]
    private Collection $paintJobs;

    #[ORM\JoinTable(name: 'app_spaceships_options')]
    #[ORM\JoinColumn(name: 'spaceship_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'option_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: BaseComponent::class, inversedBy: 'spaceships')]
    private Collection $options;

    private ConformityInspectionStatus $conformityInspectionStatus = ConformityInspectionStatus::INSPECTION_REQUIRED;

    public function __construct()
    {
        $this->paintJobs = new ArrayCollection();
        $this->options = new ArrayCollection();
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

    public function getClass(): SpaceshipClass
    {
        return $this->class;
    }

    public function setClass(SpaceshipClass $class): void
    {
        $this->class = $class;
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
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(ComponentInterface $option): void
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }
    }

    public function removeOption(ComponentInterface $option): void
    {
        $this->options->removeElement($option);
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
