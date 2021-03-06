<?php

declare(strict_types=1);

namespace App\Domain\Generics;

use App\Domain\Exception\DomainException;
use ValueError;

class AbstractEnum implements EnumInterface
{

    public const VALUES = [];

    private function __construct(
        private int|string $value
    ) {
    }

    /**
     * @throws DomainException
     */
    public static function from(int|string $value): static
    {
        $res = static::tryFrom($value);
        if ($res === null) {
            throw new DomainException();
        }

        return $res;
    }

    public static function tryFrom(int|string $value): ?static
    {
        return in_array($value, static::VALUES, true) ? new static($value) : null;
    }

    public function getValue(): int|string
    {
        return $this->value;
    }

    public function equals(EnumInterface $enum): bool
    {
        return $this->value === $enum->getValue();
    }

    public function equalsValue(int|string $value): bool
    {
        return $this->value === $value;
    }
}