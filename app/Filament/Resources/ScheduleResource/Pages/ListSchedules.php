<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected static string $view = 'filament.admin.list-schedules-resource';

    // UNUSED SINCE WE ARE USING A CUSTOM VIEW
    /*
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    */
}
