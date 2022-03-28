<?php

declare(strict_types=1);

namespace App\Application\Port\Out\Storage\Booking;

use DateTimeInterface;

interface CheckBookingAvailabilityPort{
    public function check(int $userId,DateTimeInterface $dateTime, DateTimeInterface $to): bool;
}