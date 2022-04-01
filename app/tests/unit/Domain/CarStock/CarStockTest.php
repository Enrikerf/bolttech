<?php
declare(strict_types=1);

namespace Tests\Unit\Domain\CarStock;

use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Model\JaguarModel;
use App\Domain\Car\Price\PriceCollectionVo;
use App\Domain\CarStock\CarStock;
use PHPUnit\Framework\TestCase;


class CarStockTest extends TestCase
{

    /**
     * Factors and equivalence classes:
     *  Stock --> >0, equal or greater than 0
     * tests
     *  stock = -1 -> error
     *  stock = 0   -> ok
     */
    public function constructStockExceptionTests()
    {
        $carModelVo = new CarModelVo(Brand::from(Brand::JAGUAR), JaguarModel::E_PACE);
        new CarStock(1, $carModelVo, -1, new PriceCollectionVo());
    }

    public function constructStockSuccessTests()
    {
        $carModelVo = new CarModelVo(Brand::from(Brand::JAGUAR), JaguarModel::E_PACE);
        new CarStock(1, $carModelVo, 0, new PriceCollectionVo());
    }
}