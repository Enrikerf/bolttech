<?php

declare(strict_types=1);

namespace App\Domain\Car;

use App\Domain\Generics\AbstractEnum;

class Brand extends AbstractEnum
{

    public const SEAT = "seat";
    public const JAGUAR = "jaguar";
    public const NISSAN = "nissan";
    public const MERCEDES = "mercedes";
    public const VALUES = [
        self::SEAT,
        self::JAGUAR,
        self::NISSAN,
        self::MERCEDES,
    ];
}
