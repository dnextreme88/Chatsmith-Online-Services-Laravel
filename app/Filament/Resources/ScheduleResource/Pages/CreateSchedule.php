<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Employee;
use App\Models\Schedule;
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

    protected function handleRecordCreation(array $data): Schedule
    {
        $record = new Schedule();
        $record->user_id = $data['user_id'];
        $record->employee_id = $data['employee_id'];

        foreach ($data['schedules'] as $schedule) {
            Schedule::create([
                'user_id' => $data['user_id'],
                'employee_id' => $data['employee_id'],
                'time_of_shift' => $schedule['time_of_shift'],
                'date_of_shift' => $schedule['date_of_shift'],
            ]);
        }

        return $record;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Schedule(s) created';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Create Schedules';
    }
}
