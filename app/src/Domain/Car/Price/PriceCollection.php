<?php

declare(strict_types=1);

namespace App\Domain\Car\Price;

use DateTimeInterface;

class PriceCollection
{

    public function __construct(private array $prices) {
        //TODO: check the congruency of the prices:
        //  need to get the whole year exactly
    }

    public function getAveragePriceOnRange(DateTimeInterface $from, DateTimeInterface $to): ?float
    {
        //TODO: calculate algorithm
        return 5.5;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }


}