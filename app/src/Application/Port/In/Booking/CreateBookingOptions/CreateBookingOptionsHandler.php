<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBookingOptions;

use App\Application\Exception\BadRequestException;
use App\Application\Exception\DomainException;
use App\Application\Exception\NotFoundException;
use App\Application\Port\Out\Storage\CarStock\GetCarsStockPort;
use App\Domain\CarBooking\CarBookingCollectionVo;
use App\Domain\CarBooking\CarBookingVo;
use App\Domain\CarStock\CarStock;


class CreateBookingOptionsHandler implements CreateBookingOptionsUseCase
{

    public function __construct(private GetCarsStockPort $getCarsPort) {
    }

    /**
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function handle(CreateBookingOptionsCommand $command): CarBookingOptionCollectionDto
    {
        if(!$carStockCollection = $this->getCarsPort->getStockInRange($command->getFrom(), $command->getTo())){
            throw new NotFoundException();
        }

        $bookingOptions = new CarBookingCollectionVo();

        /** @var CarStock $car */
        foreach ($carStockCollection->getCarStocks() as $car) {
            if(!$newCarBookingVo = CarBookingVo::make($car, $command->getFrom(), $command->getTo())){
                throw new BadRequestException();
            }
            $bookingOptions->add($newCarBookingVo);
        }
        return new CarBookingOptionCollectionDto($bookingOptions);
    }
}