<?php

declare(strict_types=1);

namespace App\Application\Port\Out\Storage\CarStock;


use App\Domain\Car\Model\CarModelVo;
use App\Domain\CarStock\CarStock;

interface GetCarByModelPort
{
    public function getCarByModel(CarModelVo $model): CarStock;
}
