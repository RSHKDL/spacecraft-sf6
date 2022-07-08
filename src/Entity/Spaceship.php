<?php

namespace App\Entity;

use App\Repository\SpaceshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_spaceship')]
#[ORM\Entity(repositoryClass: SpaceshipRepository::class)]
class Spaceship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $manufacturer;

    #[ORM\Column(type: 'string', length: 18)]
    private string $hullNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private string $class;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\Column(type: 'string', length: 255)]
    private string $model;

    #[ORM\OneToMany(mappedBy: 'spaceship', targetEntity: PaintJob::class)]
    private Collection $paintJobs;

    public function __construct(string $hullNumber)
    {
        $this->hullNumber = $hullNumber;
        $this->paintJobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getHullNumber(): ?string
    {
        return $this->hullNumber;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
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
}
