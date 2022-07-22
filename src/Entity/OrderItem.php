<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
#[ORM\Table(name: 'app_order_item')]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $quantity = 1;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderItem')]
    private Order $order;

    #[ORM\OneToOne(targetEntity: Spaceship::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Spaceship $spaceship;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }

    public function getSpaceship(): Spaceship
    {
        return $this->spaceship;
    }

    public function setSpaceship(Spaceship $spaceship): void
    {
        $this->spaceship = $spaceship;
    }
}
