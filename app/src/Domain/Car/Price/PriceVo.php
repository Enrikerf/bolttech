<?php

declare(strict_types=1);

namespace App\Domain\Car\Price;

use DateTimeInterface;

class PriceVo
{

    public function __construct(
        private string $code,
        private int $fromMonth,
        private int $fromDay,
        private int $toMonth,
        private int $toDay,
        private float $amount,
    ) {
    }

    public function getTotalPriceOnRange(DateTimeInterface $from, DateTimeInterface $to): ?float{
        if($from<$to){
            return null;
        }
        return null;
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

    public function getToMonth(): int
    {
        return $this->toMonth;
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