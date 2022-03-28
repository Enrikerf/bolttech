<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBookingOptions;

use App\Domain\CarBooking\CarBookingVo;

class CarBookingOptionCollectionDto
{

    private array $carBookingOptionsDto = [];

    public function __construct($carBookingOptionVoCollection)
    {
        /** @var CarBookingVo $carBookingOption */
        foreach ($carBookingOptionVoCollection->getCarBookingVos() as $carBookingOption){
            $this->carBookingOptionsDto[] = new CarBookingOptionDto($carBookingOption);
        }
    }

    public function getCarBookingOptionsDto(): array
    {
        return $this->carBookingOptionsDto;
    }

    public function setCarBookingOptionsDto(array $carBookingOptionsDto): void
    {
        $this->carBookingOptionsDto = $carBookingOptionsDto;
    }


}