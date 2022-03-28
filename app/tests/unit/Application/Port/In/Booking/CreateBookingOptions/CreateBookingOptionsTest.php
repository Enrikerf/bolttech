<?php

namespace Tests\Unit\Application\Port\In\Booking\CreateBookingOptions;

use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsCommand;
use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsHandler;
use App\Application\Port\Out\Storage\CarStock\GetCarsStockPort;
use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Price\Price;
use App\Domain\Car\Price\PriceCollection;
use App\Domain\CarStock\CarStock;
use App\Domain\CarStock\CarStockCollection;
use PHPUnit\Framework\TestCase;

class CreateBookingOptionsTest extends TestCase
{

    /**
     * Factors
     *  GetCarsStockPort null/CarStockCollection
     */
    public function handlerTest(){
        $command = new CreateBookingOptionsCommand();
        $portMock = $this->createConfiguredMock(GetCarsStockPort::class, [
            "getStockInRange"=>$this->getData()
        ]);
        $handler = new CreateBookingOptionsHandler($portMock);
        $response = $handler->handle($command);
    }

    private function getData(){
        $seat = Brand::from("seat");
        $seatLeon = new CarStock(
            1,
            $seat,
            new CarModelVo($seat, "Leon"),
            3,
            new PriceCollection([
                new Price("Peak season", 6, 1, 15, 9, 98.43),
                new Price("Mid season", 16, 9, 31, 10, 76.89),
                new Price("Off-season", 1, 11, 1, 3, 53.65),
            ])
        );
        return new CarStockCollection([
            $seatLeon
        ]);
    }


}