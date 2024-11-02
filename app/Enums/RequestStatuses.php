<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RequestStatuses: string implements HasLabel
{
    case APPROVED = 'Approved';
    case PENDING = 'Pending';
    case REJECTED = 'Rejected';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::APPROVED => 'Approved',
            self::PENDING => 'Pending',
            self::REJECTED => 'Rejected'
        };
    }
}
