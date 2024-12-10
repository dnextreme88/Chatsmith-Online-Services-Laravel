<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TimeOfShifts: string implements HasLabel
{
    case SIX_AM_TO_FIVE_PM = '6:00 AM - 5:00 PM';
    case EIGHT_AM_TO_SEVEN_PM = '8:00 AM - 7:00 PM';
    case SEVEN_PM_TO_SIX_AM = '7:00 PM - 6:00 AM';
    case NINE_PM_TO_EIGHT_AM = '9:00 PM - 8:00 AM';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SIX_AM_TO_FIVE_PM => '6:00 AM - 5:00 PM',
            self::EIGHT_AM_TO_SEVEN_PM => '8:00 AM - 7:00 PM',
            self::SEVEN_PM_TO_SIX_AM => '7:00 PM - 6:00 AM',
            self::NINE_PM_TO_EIGHT_AM => '9:00 PM - 8:00 AM'
        };
    }
}
