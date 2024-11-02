<?php

namespace App\Filament\Resources\FormRequestResource\Pages;

use App\Enums\RequestStatuses;
use App\Filament\Resources\FormRequestResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFormRequests extends ListRecords
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending-requests' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('request_status', RequestStatuses::PENDING))
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'pending-requests';
    }
}
