<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // TODO: THIS CAN BE REMOVED IF THE DATATYPE OF THE is_active FIELD IS BOOLEAN INSTEAD OF VARCHAR
    protected function mutateFormDataBeforeFill(array $data): array {
        $data['is_active'] = $data['is_active'] == 'True' ? 1 : 0;

        return $data;
    }

    // TODO: THIS CAN BE REMOVED IF THE DATATYPE OF THE is_active FIELD IS BOOLEAN INSTEAD OF VARCHAR
    protected function mutateFormDataBeforeSave(array $data): array {
        $data['is_active'] = $data['is_active'] ? 'True' : 'False';

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string {
        return 'Employee updated';
    }
}
