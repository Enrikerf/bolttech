<?php

declare(strict_types=1);

namespace App\Domain\Car\Model;

use App\Domain\Car\Brand;
use Error;

class CarModelVo
{
    public function __construct(private Brand $brand, private string $model)
    {
        if (self::exists($this->brand, $this->model)) {
            throw new Error();
        }
    }

    public static function exists(Brand $brand, string $modelName)
    {
        $checkers = [
            Brand::JAGUAR => JaguarModel::tryFrom($modelName),
            Brand::MERCEDES => MercedesModel::tryFrom($modelName),
            Brand::NISSAN => NissanModel::tryFrom($modelName),
            Brand::SEAT => SeatModel::tryFrom($modelName),
        ];

        return array_key_exists($brand->getValue(),$checkers)?$checkers[$brand->getValue()]:false;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }


}