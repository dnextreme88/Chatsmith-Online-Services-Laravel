<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array {
        $employee = User::find($data['user_id'])->employee;
        $data['employee_id'] = $employee->id;

        return $data;
    }
}
