<?php

declare(strict_types=1);

namespace App\Domain\Generics;

interface EnumInterface
{
    public static function from(int|string $value): static;

    public static function tryFrom(int|string $value): ?static;

    public function getValue(): int|string;

    public function equals(EnumInterface $enum): bool;

    public function equalsValue(int|string $value): bool;

}