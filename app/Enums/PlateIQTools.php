<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PlateIQTools: string implements HasLabel
{
    case FULL_FORM = 'Full Form';
    case NEEDS_MANAGER_REVIEW = 'Needs Manager Review (NMR)';
    case NEW_DATA_ENTRY = 'New Data Entry (NDE)';
    case PENDING_HEADER = 'Pending Header';
    case STATEMENTS = 'Statements';
    case VERIFICATION = 'Verification';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FULL_FORM => 'Full Form',
            self::NEEDS_MANAGER_REVIEW => 'Needs Manager Review (NMR)',
            self::NEW_DATA_ENTRY => 'New Data Entry (NDE)',
            self::PENDING_HEADER => 'Pending Header',
            self::STATEMENTS => 'Statements',
            self::VERIFICATION => 'Verification'
        };
    }
}
