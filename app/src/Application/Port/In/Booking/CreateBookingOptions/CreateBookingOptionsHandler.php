<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBookingOptions;

use App\Application\Port\Out\Storage\CarStock\GetCarsStockPort;
use App\Domain\CarBooking\CarBookingCollectionVo;
use App\Domain\CarBooking\CarBookingVo;
use App\Domain\CarStock\CarStock;

class CreateBookingOptionsHandler implements CreateBookingOptionsUseCase
{

    public function __construct(private GetCarsStockPort $getCarsPort) {
    }

    public function handle(CreateBookingOptionsCommand $command): CarBookingOptionCollectionDto
    {
        $carStockCollection = $this->getCarsPort->getStockInRange($command->getFrom(), $command->getTo());
        $bookingOptions = new CarBookingCollectionVo([]);

        /** @var CarStock $car */
        foreach ($carStockCollection->getCarStocks() as $car) {
            $bookingOptions->add(CarBookingVo::make($car, $command->getFrom(), $command->getTo()));
        }
        return new CarBookingOptionCollectionDto($bookingOptions);
    }
}