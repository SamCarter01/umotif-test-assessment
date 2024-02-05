<?php

namespace App\Enums;

enum DailyFrequency: int
{
    case ONE_TO_TWO = 1;
    case THREE_TO_FOUR = 2;
    case FIVE_PLUS = 3;

    public function value(): string
    {
        return match ($this)
        {
            self::ONE_TO_TWO => '1-2',
            self::THREE_TO_FOUR => '3-4',
            self::FIVE_PLUS => '5+',
            default => null,
        };
    }

    public static function allValues(): array
    {
        return array_map(fn($enum) => $enum->value(), self::cases());
    }
}
