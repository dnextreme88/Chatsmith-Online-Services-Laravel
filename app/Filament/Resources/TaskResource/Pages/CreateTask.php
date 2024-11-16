<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Employee;
use App\Models\Task;
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

    protected function handleRecordCreation(array $data): Task
    {
        $record = new Task();
        $record->user_id = $data['user_id'];
        $record->employee_id = $data['employee_id'];
        $record->task_date = $data['task_date'];

        foreach ($data['tasks'] as $task) {
            Task::create([
                'user_id' => $data['user_id'],
                'employee_id' => $data['employee_id'],
                'time_range_id' => $task['time_range_id'],
                'task_name' => $task['task_name'],
                'task_date' => $data['task_date'],
            ]);
        }

        return $record;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Task(s) created';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Create Tasks';
    }
}
