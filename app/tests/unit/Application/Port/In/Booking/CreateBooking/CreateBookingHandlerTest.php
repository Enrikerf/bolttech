<?php

namespace Tests\Unit\Application\Port\In\Booking\CreateBooking;

use App\Application\Exception\ForbiddenException;
use App\Application\Port\In\Booking\CreateBooking\CreateBookingHandler;
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


class CreateBookingHandlerTest extends TestCase
{

    /**
     * -------------------
     * Factors
     * -------------------
     *  CheckDriverLicensePort
     *  CheckBookingAvailabilityPort
     *  GetCarStockByModelPort
     *  CreateBookingPort
     * -------------------
     * Equivalence classes
     * -------------------
     *  CheckDriverLicensePort = cdlp  --> true/false
     *  CheckBookingAvailabilityPort = cbap --> true/false
     *  GetCarStockByModelPort --> null/CarStock
     *  CreateBookingPort --> null/CarBooking
     * -------------------
     * Tests
     * -------------------
     *
     * We would need to make 16 cases, to reduce the complexity providing that it's an MVP we will assume that the
     * cases with false checks will be the same because the logic couldn't continue, but we are assuming the
     * implementation and that's against TDD
     *
     * Case  cdlp       cbap    GetCarStockByModelPort  CreateBookingPort   result
     * 1     false      x       x                       x                   ForbiddenException
     * 2     true       false   x                       x                   ForbiddenException
     * 3     true       true    null                    null                NotFoundException
     * 4     true       true    null                    carBooking          NotFoundException
     * 5     true       true    carStock                null                PortException
     * 6     true       true    carStock                carBooking          success
     *
     */
    public function createBookingHandlerTest()
    {
        new CreateBookingHandler();
    }
}