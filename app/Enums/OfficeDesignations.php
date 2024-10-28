<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OfficeDesignations: string implements HasLabel
{
    case BAGUIO = 'Baguio';
    case PANGASINAN = 'Pangasinan';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BAGUIO => 'Baguio',
            self::PANGASINAN => 'Pangasinan'
        };
    }
}
