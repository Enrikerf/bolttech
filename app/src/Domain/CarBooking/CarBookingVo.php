<?php

declare(strict_types=1);

namespace App\Domain\CarBooking;

use App\Domain\CarStock\CarStock;
use DateTimeInterface;
use ValueError;

class CarBookingVo
{

    public static function make(CarStock $carStock, DateTimeInterface $from, DateTimeInterface $to): self
    {
        $nDays = $from->diff($to)->days;
        $averagePrice = $carStock->getPrices()->getAveragePriceOnRange($from, $to);
        if (!$averagePrice) {
            throw new ValueError(sprintf("Invalid"));
        }

        return new self(
            $carStock,
            $from,
            $to,
            $nDays * $averagePrice,
            $averagePrice
        );
    }

    public function __construct(
        private CarStock          $carStock,
        private DateTimeInterface $from,
        private DateTimeInterface $to,
        private float             $totalPrice,
        private float             $averagePrice,
    ) {
    }

    public function getCarStock(): CarStock
    {
        return $this->carStock;
    }

    public function getFrom(): DateTimeInterface
    {
        return $this->from;
    }

    public function getTo(): DateTimeInterface
    {
        return $this->to;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getAveragePrice(): float
    {
        return $this->averagePrice;
    }
}