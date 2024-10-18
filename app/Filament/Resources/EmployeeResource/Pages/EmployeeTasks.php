<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Enums\TaskNames;
use App\Filament\Resources\EmployeeResource;
use App\Models\Task;
use App\Models\TimeRange;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Unique;

class EmployeeTasks extends ManageRelatedRecords
{
    protected static string $resource = EmployeeResource::class;

    protected static string $relationship = 'tasks';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';

    public function getTitle(): string
    {
        $employee = $this->getRecord();

        return 'Tasks for ' .$employee->user->first_name. ' ' .$employee->user->last_name;
    }

    public function getBreadcrumb(): string
    {
        return 'Employee Tasks';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('time_range_id')
                    ->relationship(name: 'time_range', titleAttribute: 'time_range', modifyQueryUsing: fn (Builder $query) =>
                        $query->orderBy('id')
                    )
                    ->required()
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
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
                    ->options(TaskNames::class),
                DatePicker::make('task_date')
                    ->label('Date of task')
                    ->format('Y-m-d')
                    ->required()
                    ->afterOrEqual('today')
                    ->unique(ignoreRecord: true, modifyRuleUsing: fn (Unique $rule, callable $get) =>
                        $rule->where('user_id', $get('user_id'))
                            ->where('time_range_id', $get('time_range_id'))
                            ->where('task_date', $get('task_date'))
                    )
                    ->validationMessages(['unique' => 'This employee already has a task at the specified time range and date'])
            ])
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task_date')
                    ->label('Task Date')
                    ->dateTime('m/d/Y'),
                TextColumn::make('time_range.time_range')
                    ->label('Time Range'),
                TextColumn::make('task_name')
                    ->label('Task'),
            ])
            ->defaultSort(fn (Builder $query): Builder =>
                $query->orderBy('task_date', 'DESC')
                    ->orderBy('time_range_id', 'DESC')
            )
            ->filters([
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
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $employee = $this->getRecord();

                        $data['user_id'] = $employee->user->id;
                        $data['employee_id'] = $employee->id;

                        return $data;
                    }),
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
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
