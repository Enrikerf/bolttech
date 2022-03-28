<?php


declare(strict_types=1);

namespace App\Application\Port\Out\Storage\CarStock;

use App\Domain\CarStock\CarStockCollection;
use DateTimeInterface;

interface GetCarsStockPort
{
    public function getStockInRange(DateTimeInterface $dateTime, DateTimeInterface $to): ?CarStockCollection;
}