<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EmployeeTypes: string implements HasLabel
{
    case OJT = 'OJT';
    case PART_TIME = 'Part-time';
    case REGULAR = 'Regular';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::OJT => 'OJT',
            self::PART_TIME => 'Part-time',
            self::REGULAR => 'Regular'
        };
    }
}
