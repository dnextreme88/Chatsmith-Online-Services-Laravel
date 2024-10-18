<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static ?string $activeNavigationIcon = 'heroicon-s-pencil';

    public function getTitle(): string
    {
        $record = $this->getRecord();

        return 'Edit ' .$record->user->last_name. ', ' .$record->user->first_name;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Employee updated';
    }
}
