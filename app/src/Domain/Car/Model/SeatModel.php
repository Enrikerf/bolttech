<?php

declare(strict_types=1);

namespace App\Domain\Car\Model;

use App\Domain\Generics\AbstractEnum;

class SeatModel extends AbstractEnum
{
    public const LEON = "leon";
    public const IBIZA = "Ibiza";
    public const VALUES = [];
}