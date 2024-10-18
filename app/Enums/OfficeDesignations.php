<?php

namespace App\Enums;

enum OfficeDesignations: string
{
    case BAGUIO = 'Baguio';
    case PANGASINAN = 'Pangasinan';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
