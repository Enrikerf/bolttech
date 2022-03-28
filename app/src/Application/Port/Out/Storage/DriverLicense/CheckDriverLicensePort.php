<?php

declare(strict_types=1);

namespace App\Application\Port\Out\Storage\DriverLicense;

use DateTimeInterface;

interface CheckDriverLicensePort{
    public function check(int $userId, DateTimeInterface $from, DateTimeInterface $to): bool;
}