<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EmployeeRoles: string implements HasLabel
{
    case ADMINISTRATOR = 'Administrator';
    case DIRECTOR = 'Director';
    case EMPLOYEE = 'Employee';
    case HR = 'Human Resources and Recruitment';
    case OWNER = 'Owner';
    case QA = 'Quality Analyst';
    case SUPERVISOR = 'Supervisor';
    case TEAM_LEADER = 'Team Leader';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMINISTRATOR => 'Administrator',
            self::DIRECTOR => 'Director',
            self::EMPLOYEE => 'Employee',
            self::HR => 'Human Resources and Recruitment',
            self::OWNER => 'Owner',
            self::QA => 'Quality Analyst',
            self::SUPERVISOR => 'Supervisor',
            self::TEAM_LEADER => 'Team Leader'
        };
    }
}
