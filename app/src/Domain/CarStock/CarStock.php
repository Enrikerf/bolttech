<?php

declare(strict_types=1);

namespace App\Domain\CarStock;

use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Price\PriceCollection;
use ValueError;


class CarStock
{
    public function __construct(
        private int $id,
        private Brand $brand,
        private CarModelVo $model,
        private int $stock,
        private PriceCollection $prices,
    ) {
        if($this->stock <0){
            throw new ValueError("Invalid value");
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function getModel(): CarModelVo
    {
        return $this->model;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getPrices(): PriceCollection
    {
        return $this->prices;
    }
}