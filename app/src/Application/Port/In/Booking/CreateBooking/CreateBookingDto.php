<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBooking;

use App\Domain\CarBooking\CarBooking;

class CreateBookingDto{
    private int $id;
    public function __construct(CarBooking $carBooking){
        $this->id = $carBooking->getId();
    }
    public function getId(): int
    {
        return $this->id;
    }

}