<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: CartItemRepository::class)]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Spaceship::class)]
    private Spaceship $spaceship;

    #[ORM\Column(type: 'array', nullable: true)]
    private array $options = [];

    #[ORM\Column(type: 'integer')]
    private int $quantity = 1;

    public function __construct(Spaceship $product)
    {
        $this->spaceship = $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpaceship(): ?Spaceship
    {
        return $this->spaceship;
    }

    public function setSpaceship(?Spaceship $spaceship): void
    {
        $this->spaceship = $spaceship;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): void
    {
        $this->options = $options;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
