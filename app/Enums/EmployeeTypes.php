<?php

namespace App\Enums;

enum EmployeeTypes: string
{
    case OJT = 'OJT';
    case PART_TIME = 'Part-time';
    case REGULAR = 'Regular';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
