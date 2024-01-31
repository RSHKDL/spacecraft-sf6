<?php

namespace App\Entity;

use App\Manufacturer\Enum\ManufacturerSatisfactionThreshold;
use App\Repository\ManufacturerStatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'app_manufacturer_statistics')]
#[ORM\Entity(repositoryClass: ManufacturerStatisticsRepository::class)]
class ManufacturerStatistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ManufacturerSatisfactionThreshold $customerSatisfaction = ManufacturerSatisfactionThreshold::MISSING;

    #[ORM\Column]
    private int $ongoingOrders = 0;

    #[ORM\Column]
    private int $averageLeadTime = 0;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'statistics', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $manufacturer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerSatisfaction(): ManufacturerSatisfactionThreshold
    {
        return $this->customerSatisfaction;
    }

    public function setCustomerSatisfaction(ManufacturerSatisfactionThreshold $customerSatisfaction): static
    {
        $this->customerSatisfaction = $customerSatisfaction;

        return $this;
    }

    public function getOngoingOrders(): ?int
    {
        return $this->ongoingOrders;
    }

    public function setOngoingOrders(int $ongoingOrders): static
    {
        $this->ongoingOrders = $ongoingOrders;

        return $this;
    }

    public function getAverageLeadTime(): ?int
    {
        return $this->averageLeadTime;
    }

    public function setAverageLeadTime(int $averageLeadTime): static
    {
        $this->averageLeadTime = $averageLeadTime;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }
}
