<?php

declare(strict_types=1);

namespace App\Adapter\Out\Persistence\DatabaseMock;

use App\Application\Port\Out\Storage\DriverLicense\CheckDriverLicensePort;
use DateTimeInterface;

class DriverLicenseRepository implements CheckDriverLicensePort{

    public function check(int $userId, DateTimeInterface $from, DateTimeInterface $to): bool
    {
        // TODO: Implement check() method.
        return true;
    }
}