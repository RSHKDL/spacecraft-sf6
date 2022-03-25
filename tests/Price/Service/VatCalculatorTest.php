<?php

namespace Price\Service;

use App\Price\Service\VatCalculator;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class VatCalculatorTest extends TestCase
{
    /**
     * @dataProvider pricesAndRatesProvider
     */
    public function testCalculateVat(int $price, float $rate, int $expected): void
    {
        $vatCalculator = new VatCalculator();
        $this->assertSame($expected, $vatCalculator->apply($price, $rate));
    }

    #[ArrayShape(['100€ at 20%' => "array", '100€ at 5.5%' => "array"])]
    private function pricesAndRatesProvider(): array
    {
        return [
            '100€ at 20%' => [10000, VatCalculator::NORMAL_RATE, 12000],
            '100€ at 5.5%' => [10000, VatCalculator::REDUCED_RATE, 10550],
        ];
    }
}