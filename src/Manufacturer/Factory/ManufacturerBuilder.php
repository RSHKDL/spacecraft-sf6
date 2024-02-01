<?php

namespace App\Manufacturer\Factory;

use App\Entity\Manufacturer;
use App\Entity\ManufacturerStatistics;
use App\Manufacturer\Enum\ManufacturerSatisfactionThreshold;

class ManufacturerBuilder
{
    private string $name;
    private int $shipyards = 0;
    private int $assemblyLines = 0;
    private ?ManufacturerStatistics $statistics = null;

    public function build(): Manufacturer
    {
        $manufacturer = new Manufacturer($this->name);
        $manufacturer->setShipyards($this->shipyards);
        $manufacturer->setAssemblyLines($this->assemblyLines);
        $manufacturer->setStatistics($this->statistics);

        return $manufacturer;
    }

    public function createManufacturerNamed(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withStatistics(
        ManufacturerSatisfactionThreshold $satisfactionThreshold,
        int $ongoingOrders,
        int $averageLeadTime
    ): self
    {
        $statistics = new ManufacturerStatistics();
        $statistics->setCustomerSatisfaction($satisfactionThreshold);
        $statistics->setOngoingOrders($ongoingOrders);
        $statistics->setAverageLeadTime($averageLeadTime);
        $statistics->setUpdatedAt(new \DateTimeImmutable());

        $this->statistics = $statistics;

        return $this;
    }

    public function withProductionCapacityOf(int $shipyards, int $assemblyLines): self
    {
        $this->shipyards = $shipyards;
        $this->assemblyLines = $assemblyLines;

        return $this;
    }
}
