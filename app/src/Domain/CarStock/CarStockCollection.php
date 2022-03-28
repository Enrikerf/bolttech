<?php

declare(strict_types=1);

namespace App\Domain\CarStock;

use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Price\PriceCollection;
use App\Domain\CarBooking\CarBookingVo;
use ValueError;


class CarStockCollection
{
    public function __construct(
        private array $carStocks
    ) {

    }

    public function add(CarStock $carStock)
    {
        $this->carStocks[] = $carStock;
    }

    public function getCarStocks(): array
    {
        return $this->carStocks;
    }



}