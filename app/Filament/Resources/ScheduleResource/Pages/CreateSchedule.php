<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Employee;
use Filament\Resources\Pages\CreateRecord;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $employee = Employee::where('user_id', $data['user_id'])->first();

        $data['employee_id'] = $employee->id;

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Schedule created';
    }
}
