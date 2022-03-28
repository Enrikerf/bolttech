<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBookingOptions;

use DateTimeInterface;
use ValueError;

class CreateBookingOptionsCommand
{

    public function __construct(
        private DateTimeInterface $from,
        private DateTimeInterface $to,
    ) {
        if( $this->from > $this->to){
            throw new ValueError(sprintf("Invalid"));
        }
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