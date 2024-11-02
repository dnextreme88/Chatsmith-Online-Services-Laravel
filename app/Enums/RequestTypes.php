<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RequestTypes: string implements HasLabel
{
    case EARLY_IN = 'Early In';
    case EARLY_OUT = 'Early Out';
    case LUNCH_BREAK_OT = 'Lunch Break OT / 1 Hour OT';
    case SICK_LEAVE = 'Sick Leave';
    case VACATION_LEAVE = 'Vacation Leave';
    case VOLUNTARY_TIME_OFF = 'Voluntary Time Off (VTO)';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::EARLY_IN => 'Early In',
            self::EARLY_OUT => 'Early Out',
            self::LUNCH_BREAK_OT => 'Lunch Break OT / 1 Hour OT',
            self::SICK_LEAVE => 'Sick Leave',
            self::VACATION_LEAVE => 'Vacation Leave',
            self::VOLUNTARY_TIME_OFF => 'Voluntary Time Off (VTO)'
        };
    }
}
