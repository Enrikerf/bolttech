<?php

declare(strict_types=1);

namespace App\Adapter\Out\Persistence\DatabaseMock;


use App\Application\Port\Out\Storage\CarStock\GetCarByModelPort;
use App\Application\Port\Out\Storage\CarStock\GetCarsStockPort;
use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Model\JaguarModel;
use App\Domain\Car\Model\MercedesModel;
use App\Domain\Car\Model\NissanModel;
use App\Domain\Car\Model\SeatModel;
use App\Domain\Car\Price\Price;
use App\Domain\Car\Price\PriceCollection;
use App\Domain\CarStock\CarStock;
use App\Domain\CarStock\CarStockCollection;
use DateTimeInterface;

class CarStockRepository implements GetCarsStockPort, GetCarByModelPort
{
    private CarStockCollection $carStocks;
    private array $models;

    public function __construct()
    {
        $seat = Brand::from("seat");
        $nissan = Brand::from("nissan");
        $jaguar = Brand::from("jaguar");
        $mercedes = Brand::from("mercedes");

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
        $seatIbiza = new CarStock(
            2,
            $seat,
            new CarModelVo($seat, "Ibiza"),
            5,
            new PriceCollection([
                new Price("Peak season", 6, 1, 15, 9, 85.12),
                new Price("Mid season", 16, 9, 31, 10, 65.73),
                new Price("Off-season", 1, 11, 1, 3, 46.85),
            ])
        );
        $nissanQasqai = new CarStock(
            3,
            $nissan,
            new CarModelVo($nissan, "Qasqai"),
            2,
            new PriceCollection([
                new Price("Peak season", 6, 1, 15, 9, 85.12),
                new Price("Mid season", 16, 9, 31, 10, 65.73),
                new Price("Off-season", 1, 11, 1, 3, 46.85),
            ])
        );
        $jaguarEpace = new CarStock(
            4,
            $jaguar,
            new CarModelVo($jaguar, "e-pace"),
            1,
            new PriceCollection([
                new Price("Peak season", 6, 1, 15, 9, 85.12),
                new Price("Mid season", 16, 9, 31, 10, 65.73),
                new Price("Off-season", 1, 11, 1, 3, 46.85),
            ])
        );
        $mercedesVito = new CarStock(
            5,
            $mercedes,
            new CarModelVo($mercedes, "vito"),
            1,
            new PriceCollection([
                new Price("Peak season", 6, 1, 15, 9, 85.12),
                new Price("Mid season", 16, 9, 31, 10, 65.73),
                new Price("Off-season", 1, 11, 1, 3, 46.85),
            ])
        );
        $this->carStocks = new CarStockCollection([
            $seatLeon,
            $seatIbiza,
            $nissanQasqai,
            $jaguarEpace,
            $mercedesVito
        ]);

        $this->models = [
            SeatModel::LEON => $seatLeon,
            SeatModel::IBIZA => $seatIbiza,
            NissanModel::QUASQAI => $nissanQasqai,
            JaguarModel::E_PACE => $jaguarEpace,
            MercedesModel::VITO => $mercedesVito,
        ];
    }

    public function getStockInRange(DateTimeInterface $dateTime, DateTimeInterface $to): ?CarStockCollection
    {
        // TODO: Implement with database
        // TODO: check bookings in this dates:
        //  * amount of bookings in that date must be less than stock to return this carStock
        return $this->carStocks;
    }

    public function getCarByModel(CarModelVo $model): CarStock
    {
        return $this->models[$model->getModel()];
    }
}