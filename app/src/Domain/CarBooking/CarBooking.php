<?php

declare(strict_types=1);

namespace App\Domain\CarBooking;

use App\Domain\CarStock\CarStock;
use DateTimeInterface;

class CarBooking
{

    public function __construct(
        private int               $id,
        private CarStock          $carStock,
        private DateTimeInterface $from,
        private DateTimeInterface $to,
        private float             $totalPrice,
        private float             $averagePrice,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
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