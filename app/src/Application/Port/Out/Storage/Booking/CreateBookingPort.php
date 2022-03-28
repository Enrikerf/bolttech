<?php

declare(strict_types=1);

namespace App\Application\Port\Out\Storage\Booking;

use App\Domain\CarBooking\CarBooking;
use App\Domain\CarBooking\CarBookingVo;

interface CreateBookingPort
{
    public function create(CarBookingVo $carBookingVo): CarBooking;
}