<?php

namespace Tests\Unit\Application\Port\In\Booking\CreateBookingOptions;

use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsCommand;
use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsHandler;
use App\Application\Port\Out\Storage\CarStock\GetCarsStockPort;
use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Price\PriceVo;
use App\Domain\Car\Price\PriceCollectionVo;
use App\Domain\CarBooking\CarBookingVo;
use App\Domain\CarStock\CarStock;
use App\Domain\CarStock\CarStockCollection;
use PHPUnit\Framework\TestCase;

class CreateBookingOptionsTest extends TestCase
{

    /**
     * -------------------
     * Factors
     * -------------------
     *  GetCarsStockPort
     *  CarBookingVo::make
     * -------------------
     * Equivalence classes
     * -------------------
     *  GetCarsStockPort --> null/CarStockCollection
     *  CarBookingVo::make -->  null/CarBookingVo
     * -------------------
     * Tests
     * -------------------
     * Case     GetCarsStockPort     CarBookingVo::make      result
     * 1        null                 null                    NotFoundException
     * 2        null                 CarBookingVo            NotFoundException
     * 3        CarStockCollection   null                    DomainException
     * 4        CarStockCollection   CarBookingVo            Success
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
            new PriceCollectionVo([
                new PriceVo("Peak season", 6, 1, 15, 9, 98.43),
                new PriceVo("Mid season", 16, 9, 31, 10, 76.89),
                new PriceVo("Off-season", 1, 11, 1, 3, 53.65),
            ])
        );
        return new CarStockCollection([
            $seatLeon
        ]);
    }


}