<?php

declare(strict_types=1);

namespace App\Adapter\Out\Persistence\DatabaseMock;

use App\Application\Port\Out\Storage\Booking\CheckBookingAvailabilityPort;
use App\Application\Port\Out\Storage\Booking\CreateBookingPort;
use App\Domain\CarBooking\CarBooking;
use App\Domain\CarBooking\CarBookingVo;
use DateTimeInterface;

class BookingRepository implements CheckBookingAvailabilityPort,CreateBookingPort
{
    public function check(int $userId,DateTimeInterface $dateTime, DateTimeInterface $to): bool
    {
        // TODO: stock > 0 in notes specify that will be better to have a generic search method with filters
        // TODO: check that the car it's available on this range of time -> amount of bookings on that range < stock
        return true;
    }

    public function create(CarBookingVo $carBookingVo): ?CarBooking
    {
        // TODO: Implement create() method.
        // TODO: lock tables, check amount Of Bookings on that range < stock, create booking, unlock table
        return new CarBooking(
            1,
            $carBookingVo->getCarStock(),
            $carBookingVo->getFrom(),
            $carBookingVo->getTo(),
            $carBookingVo->getTotalPrice(),
            $carBookingVo->getAveragePrice(),
        );
    }
}