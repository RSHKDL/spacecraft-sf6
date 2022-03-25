<?php

namespace App\Price\Service;

class VatCalculator
{
    public const NORMAL_RATE = 20;
    public const REDUCED_RATE = 5.5;

    public function apply(int $price, float $rate): int
    {
        $price = $price / 100;
        $price = $price + ($price * $rate / 100);

        return $price * 100;
    }
}