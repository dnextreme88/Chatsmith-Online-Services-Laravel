<?php

namespace App\Enums;

enum EmployeeRoles: string
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
}
