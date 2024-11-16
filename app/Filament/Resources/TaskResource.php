<?php

namespace App\Filament\Resources;

use App\Enums\TaskNames;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use App\Models\TimeRange;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([ // employee_id field is saved in CreateTask.php
                Select::make('user_id')
                    ->label('Employee')
                    ->relationship(name: 'user', modifyQueryUsing: fn (Builder $query) =>
                        $query->whereHas('employee', fn (Builder $inner_query) =>
                            $inner_query->where('is_active', 1)
                        )
                        ->orderBy('users.last_name')
                    )
                    ->getOptionLabelFromRecordUsing(fn (User $record) => $record->last_name. ', ' .$record->first_name. ' ' .$record->middle_name)
                    ->required(),
                DatePicker::make('task_date')
                    ->label('Date of task')
                    ->format('Y-m-d')
                    ->required()
                    ->afterOrEqual('today'),
                Select::make('time_range_id')
                    ->relationship(name: 'time_range', titleAttribute: 'time_range', modifyQueryUsing: fn (Builder $query) =>
                        $query->orderBy('id')
                    )
                    ->required()
                    ->hidden(fn (string $operation): bool => $operation === 'create')
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $employee_has_task = Task::select(['user_id', 'time_range_id'])->where('user_id', $get('user_id'))
                                ->where('time_range_id', $value)
                                ->where('task_date', $get('task_date'))
                                ->first();

                            if ($employee_has_task) {
                                $fail('This employee already has a task at the specified time range and date');
                            }

                            // TODO: TO TURN THIS INTO A CUSTOM MODEL FUNCTION FOR DRY PRINCIPLE
                            $time_range = TimeRange::find($value)->time_range;
                            $splitted_time_range = explode(' ', $time_range);
                            $start_time = $splitted_time_range[0]. ':00';
                            $start_time_am_or_pm = $splitted_time_range[1];

                            if ($start_time == '12:00:00') {
                                $start_time = str_replace('12:', '00:', $start_time);
                            }

                            $parsed_time = Carbon::parse($get('task_date'). ' ' .$start_time);

                            if ($start_time_am_or_pm == 'PM') {
                                $parsed_time = $parsed_time->addHours(12);
                            }

                            if (Carbon::now() > $parsed_time) {
                                $fail('The start time of the selected time range cannot be less than the current date and time');
                            }
                        }
                    ]),
                Select::make('task_name')
                    ->label('Task')
                    ->required()
                    ->hidden(fn (string $operation): bool => $operation === 'create')
                    ->options(TaskNames::class),
                Repeater::make('tasks')
                    ->addActionLabel('Add more tasks')
                    ->maxItems(10)
                    ->hidden(fn (string $operation): bool => $operation === 'edit')
                    ->reorderable(false)
                    ->schema([
                        Select::make('time_range_id')
                            ->relationship(name: 'time_range', titleAttribute: 'time_range', modifyQueryUsing: fn (Builder $query) =>
                                $query->orderBy('id')
                            )
                            ->required()
                            ->distinct()
                            ->rules([
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                    $employee_has_task = Task::select(['user_id', 'time_range_id'])->where('user_id', $get('../../user_id'))
                                        ->where('time_range_id', $value)
                                        ->where('task_date', $get('../../task_date'))
                                        ->first();

                                    if ($employee_has_task) {
                                        $fail('This employee already has a task at the specified time range and date');
                                    }

                                    // TODO: TO TURN THIS INTO A CUSTOM MODEL FUNCTION FOR DRY PRINCIPLE
                                    $time_range = TimeRange::find($value)->time_range;
                                    $splitted_time_range = explode(' ', $time_range);
                                    $start_time = $splitted_time_range[0]. ':00';
                                    $start_time_am_or_pm = $splitted_time_range[1];

                                    if ($start_time == '12:00:00') {
                                        $start_time = str_replace('12:', '00:', $start_time);
                                    }

                                    $parsed_time = Carbon::parse($get('task_date'). ' ' .$start_time);

                                    if ($start_time_am_or_pm == 'PM') {
                                        $parsed_time = $parsed_time->addHours(12);
                                    }

                                    if (Carbon::now() > $parsed_time) {
                                        $fail('The start time of the selected time range cannot be less than the current date and time');
                                    }
                                }
                            ]),
                        Select::make('task_name')
                            ->label('Task')
                            ->required()
                            ->options(TaskNames::class)
                ])
            ])
            ->columns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.full_name')
                    ->label('Employee'),
                TextEntry::make('task_name')
                    ->label('Task'),
                TextEntry::make('task_date')
                    ->badge()
                    ->date()
                    ->color('success'),
                TextEntry::make('time_range.time_range')
                    ->label('Time range')
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.full_name')
                    ->label('Employee')
                    ->searchable(['first_name', 'maiden_name', 'last_name'])
                    ->sortable(['first_name']),
                TextColumn::make('task_date')
                    ->label('Task Date')
                    ->dateTime('m/d/Y'),
                TextColumn::make('time_range.time_range')
                    ->label('Time Range'),
                TextColumn::make('task_name')
                    ->label('Task')
            ])
            ->defaultSort(fn (Builder $query): Builder =>
                $query->orderBy('task_date', 'DESC')
                    ->orderBy('time_range_id', 'DESC')
            )
            ->filters([
                SelectFilter::make('user')
                    ->options(User::selectRaw('id, CONCAT(COALESCE(`first_name`, ""), " ", COALESCE(`last_name`, "")) AS employee_name')
                        ->whereHas('employee', fn ($query) => $query->where('is_active', 1))
                        ->orderBy('last_name')
                        ->get()
                        ->pluck('employee_name', 'id') // Using ->pluck('full_name', 'id') fails as it is an accessor function in App\Models\User
                    )
                    ->query(function (Builder $query, array $data) {
                        // REF: https://v2.filamentphp.com/tricks/use-selectfilter-on-distant-relationships
                        if (!empty($data['value'])) {
                            return $query->whereHas('user',
                                fn (Builder $query) => $query->where('id', '=', (int) $data['value'])
                            );
                        }
                    })
                    ->label('Employee'),
                SelectFilter::make('time_range_id')
                    ->label('Time range')
                    ->options(fn () => TimeRange::pluck('time_range', 'id')->toArray()),
                SelectFilter::make('task_name')
                    ->label('Task')
                    ->options(TaskNames::class),
                Filter::make('task_date')
                    ->form([
                        DatePicker::make('task_date_from')
                            ->label('Date (from)'),
                        DatePicker::make('task_date_to')
                            ->label('Date (to)')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['task_date_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('task_date', '>=', $date)
                            )
                            ->when(
                                $data['task_date_to'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('task_date', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['task_date_from']) {
                            $indicators['task_date_from'] = 'Date from: ' .Carbon::parse($data['task_date_from'])->toFormattedDateString();
                        }

                        if ($data['task_date_to']) {
                            $indicators['task_date_to'] = 'Date to: ' .Carbon::parse($data['task_date_to'])->toFormattedDateString();
                        }

                        return $indicators;
                    })
            ])
            ->groups([
                Group::make('time_range.time_range')
                    ->label('Task Range'),
                Group::make('task_name')
                    ->label('Task')
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
                    ->hidden(function (Task $record): bool {
                        // TODO: TO TURN THIS INTO A CUSTOM MODEL FUNCTION FOR DRY PRINCIPLE
                        $time_range = TimeRange::find($record->time_range_id)->time_range;
                        $splitted_time_range = explode(' ', $time_range);
                        $start_time = $splitted_time_range[0]. ':00';
                        $start_time_am_or_pm = $splitted_time_range[1];

                        if ($start_time == '12:00:00') {
                            $start_time = str_replace('12:', '00:', $start_time);
                        }

                        $parsed_time = Carbon::parse($record->task_date. ' ' .$start_time);

                        if ($start_time_am_or_pm == 'PM') {
                            $parsed_time = $parsed_time->addHours(12);
                        }

                        $is_today_greater_than_task_start_time = Carbon::now() > $parsed_time;

                        return $is_today_greater_than_task_start_time;
                    }),
                DeleteAction::make()
                    ->hidden(function (Task $record): bool {
                        // TODO: TO TURN THIS INTO A CUSTOM MODEL FUNCTION FOR DRY PRINCIPLE
                        $time_range = TimeRange::find($record->time_range_id)->time_range;
                        $splitted_time_range = explode(' ', $time_range);
                        $start_time = $splitted_time_range[0]. ':00';
                        $start_time_am_or_pm = $splitted_time_range[1];

                        if ($start_time == '12:00:00') {
                            $start_time = str_replace('12:', '00:', $start_time);
                        }

                        $parsed_time = Carbon::parse($record->task_date. ' ' .$start_time);

                        if ($start_time_am_or_pm == 'PM') {
                            $parsed_time = $parsed_time->addHours(12);
                        }

                        $is_today_greater_than_task_start_time = Carbon::now() > $parsed_time;

                        return $is_today_greater_than_task_start_time;
                    })
                    ->successNotificationTitle('Task deleted')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
