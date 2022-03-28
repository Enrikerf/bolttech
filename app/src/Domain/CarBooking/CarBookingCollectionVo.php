<?php

declare(strict_types=1);

namespace App\Domain\CarBooking;

class CarBookingCollectionVo
{
    public function __construct(private array $carBookingVos =[])
    {
    }

    public function add(CarBookingVo $carBookingVo)
    {
        $this->carBookingVos[] = $carBookingVo;
    }

    public function getCarBookingVos(): array
    {
        return $this->carBookingVos;
    }


}