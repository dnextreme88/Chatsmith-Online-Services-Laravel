<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Employee;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $employee = Employee::where('user_id', $data['user_id'])->first();

        $data['employee_id'] = $employee->id;

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Task created';
    }
}
