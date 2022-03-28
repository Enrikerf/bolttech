<?php

namespace App\Application\Port\In\Booking\CreateBookingOptions;

interface CreateBookingOptionsUseCase
{
    public function handle(CreateBookingOptionsCommand $command): CarBookingOptionCollectionDto;
}