<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static ?string $activeNavigationIcon = 'heroicon-s-eye';

    public function getTitle(): string
    {
        $record = $this->getRecord();

        return $record->user->last_name. ', ' .$record->user->first_name;
    }

    protected function getActions(): array
    {
        return [];
    }
}
