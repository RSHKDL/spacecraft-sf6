<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartItemRepository::class)]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    private Product $product;

    #[ORM\Column(type: 'array', nullable: true)]
    private array $options = [];

    #[ORM\Column(type: 'integer')]
    private int $quantity = 1;

    #[ORM\ManyToOne(targetEntity: ProductOptions::class)]
    private ProductOptions $color;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getColor(): ?ProductOptions
    {
        return $this->color;
    }

    public function setColor(?ProductOptions $color): self
    {
        $this->color = $color;

        return $this;
    }
}
