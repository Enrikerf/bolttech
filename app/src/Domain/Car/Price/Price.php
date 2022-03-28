<?php

declare(strict_types=1);

namespace App\Domain\Car\Price;

use DateTimeInterface;

class Price
{

    public function __construct(
        private string $code,
        private int $fromMonth,
        private int $fromDay,
        private int $toMoth,
        private int $toDay,
        private float $amount,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getFromMonth(): int
    {
        return $this->fromMonth;
    }

    public function getFromDay(): int
    {
        return $this->fromDay;
    }

    public function getToMoth(): int
    {
        return $this->toMoth;
    }

    public function getToDay(): int
    {
        return $this->toDay;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }





}