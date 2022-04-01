<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBooking;

use App\Application\Exception\BadRequestException;
use App\Application\Exception\ForbiddenException;
use App\Application\Exception\NotFoundException;
use App\Application\Exception\PortException;
use App\Application\Port\Out\Storage\Booking\CheckBookingAvailabilityPort;
use App\Application\Port\Out\Storage\Booking\CreateBookingPort;
use App\Application\Port\Out\Storage\CarStock\GetCarByModelPort;
use App\Application\Port\Out\Storage\DriverLicense\CheckDriverLicensePort;
use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\CarBooking\CarBookingVo;
use App\Domain\Exception\DomainException;


class CreateBookingHandler implements CreateBookingUseCase
{
    public function __construct(
        private CheckDriverLicensePort $checkDriverLicensePort,
        private CheckBookingAvailabilityPort $checkBookingAvailabilityPort,
        private GetCarByModelPort $getCarByModelPort,
        private CreateBookingPort $createBookingPort,
    ){}

    /**
     * @throws NotFoundException
     * @throws BadRequestException
     * @throws PortException
     */
    public function handle(CreateBookingCommand $command): CreateBookingDto
    {
        if(!$this->checkDriverLicensePort->check($command->getUserId(),$command->getFrom(),$command->getTo())){
            throw new ForbiddenException("Expired License");
        }
        if(!$this->checkBookingAvailabilityPort->check($command->getUserId(),$command->getFrom(),$command->getTo())){
            throw new ForbiddenException("Already have a booking");
        }
        if(!$carStock = $this->getCarByModelPort->getCarStockByModel($command->getModel())){
            throw new NotFoundException("Model not found exception");
        }
        if(!$carBookingVo = CarBookingVo::make($carStock,$command->getFrom(),$command->getTo())){
            throw new BadRequestException();
        }
        if($carBooking = $this->createBookingPort->create($carBookingVo)){
            throw new PortException();
        }
        return new CreateBookingDto($carBooking);
    }
}