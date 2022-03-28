<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBooking;

use DateTimeInterface;

class CreateBookingCommand{
    public function __construct(
        private int $userId,
        private string $brand,
        private string $model,
        private DateTimeInterface $from,
        private DateTimeInterface $to,
    ){}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getFrom(): DateTimeInterface
    {
        return $this->from;
    }

    public function getTo(): DateTimeInterface
    {
        return $this->to;
    }


}