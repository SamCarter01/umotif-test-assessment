<?php

namespace App\Enums;

enum Frequency: int
{
    case MONTHLY = 1;
    case WEEKLY = 2;
    case DAILY = 3;

    public function value(): string
    {
        return match ($this)
        {
            self::MONTHLY => 'Monthly',
            self::WEEKLY => 'Weekly',
            self::DAILY => 'Daily',
            default => null,
        };
    }

    public static function allValues(): array
    {
        return array_map(fn($enum) => $enum->value(), self::cases());
    }
}
