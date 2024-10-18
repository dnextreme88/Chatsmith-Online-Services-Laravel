<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Carbon\Carbon;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'todays-tasks' => Tab::make('Today\'s tasks')
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->where('task_date', Carbon::today())
                        ->orderBy('time_range_id', 'ASC')
                ),
            'upcoming-tasks' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->where('task_date', '>', Carbon::today())
                        ->orderBy('time_range_id', 'ASC')
                )
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'todays-tasks';
    }
}
