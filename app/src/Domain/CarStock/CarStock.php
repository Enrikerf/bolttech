<?php

declare(strict_types=1);

namespace App\Domain\CarStock;

use App\Domain\Car\Brand;
use App\Domain\Car\Model\CarModelVo;
use App\Domain\Car\Price\PriceCollectionVo;
use App\Domain\Exception\DomainException;
use ValueError;


class CarStock
{
    public function __construct(
        private int $id,
        private CarModelVo $model,
        private int $stock,
        private PriceCollectionVo $prices,
    ) {
        if($this->stock <0){
            throw new DomainException();
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): Brand
    {
        return $this->model->getBrand();
    }

    public function getModel(): CarModelVo
    {
        return $this->model;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getPrices(): PriceCollectionVo
    {
        return $this->prices;
    }
}