<?php
declare(strict_types=1);

namespace Tests\Unit\Domain\CarBooking;

use App\Domain\Car\Price\PriceCollectionVo;
use App\Domain\CarBooking\CarBookingVo;
use App\Domain\CarStock\CarStock;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;


class CarBookingVoTest extends TestCase
{

    /**
     * Factors
     *      from/to, carStock->prices->getAveragePriceOnRange
     * Equivalence clases
     *      from/to --> to<from, from-to > year, right From and To
     *      carStock->prices->getAveragePriceOnRange = float,null
     * Tests
     *
     * case     from/to         carStock->prices->getAveragePriceOnRange    result
     * 1        to<from         null                                        null because invalid range
     * 2        to<from         float                                       null because invalid range
     * 3        from-to > year  null                                        null because invalid range
     * 4        from-to > year  float                                       null because invalid range
     * 5        right from/to   null                                        null invalid averagePriceCalculation
     * 6        right from/to   float                                       success
     *
     */
    public function makeTest()
    {
        $PriceCollectionMock = $this->createConfiguredMock(PriceCollectionVo::class, [
            "getAveragePriceOnRange" => 4,
        ]);
        $carStockMock = $this->createConfiguredMock(CarStock::class, [
            "getPrices" => $PriceCollectionMock,
        ]);
        CarBookingVo::make($carStockMock, new DateTimeImmutable(), new DateTimeImmutable());
    }
}