<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBooking;

use App\Application\Port\Out\Storage\Booking\CheckBookingAvailabilityPort;
use App\Application\Port\Out\Storage\Booking\CreateBookingPort;
use App\Application\Port\Out\Storage\CarStock\GetCarByModelPort;
use App\Application\Port\Out\Storage\DriverLicense\CheckDriverLicensePort;
use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\CarBooking\CarBookingVo;
use ValueError;

class CreateBookingHandler implements CreateBookingUseCase
{
    public function __construct(
        private GetCarByModelPort $getCarByModelPort,
        private CheckDriverLicensePort $checkDriverLicensePort,
        private CheckBookingAvailabilityPort $checkBookingAvailabilityPort,
        private CreateBookingPort $createBookingPort,
    ){}

    public function handle(CreateBookingCommand $command): CreateBookingDto
    {
        if(!$carBrand = Brand::tryFrom($command->getBrand())){
            throw new ValueError(sprintf("Invalid Brand"));
        }
        $carModelVo = new CarModelVo($carBrand,$command->getModel());
        if(!$this->checkDriverLicensePort->check($command->getUserId(),$command->getFrom(),$command->getTo())){
            throw new ValueError(sprintf("Expired License"));
        }
        if(!$this->checkBookingAvailabilityPort->check($command->getUserId(),$command->getFrom(),$command->getTo())){
            throw new ValueError(sprintf("Already have a booking"));
        }
        $car = $this->getCarByModelPort->getCarByModel($carModelVo);
        $carBookingVo = CarBookingVo::make($car,$command->getFrom(),$command->getTo());
        $carBooking = $this->createBookingPort->create($carBookingVo);
        return new CreateBookingDto($carBooking);
    }
}