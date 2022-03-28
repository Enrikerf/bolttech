<?php

namespace App\Application\Port\In\Booking\CreateBooking;

interface CreateBookingUseCase
{
    public function handle(CreateBookingCommand $command): CreateBookingDto;
}