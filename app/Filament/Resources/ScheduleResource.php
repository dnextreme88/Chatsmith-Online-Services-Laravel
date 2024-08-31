<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([ // employee_id field is saved in CreateSchedule.php
                Select::make('user_id')
                    ->label('Employee')
                    ->relationship(name: 'user', modifyQueryUsing: fn (Builder $query) =>
                        $query->whereHas('employee', fn (Builder $inner_query) =>
                            $inner_query->where('is_active', 1)
                        )
                        ->orderBy('users.last_name')
                    )
                    ->getOptionLabelFromRecordUsing(fn (User $record) => $record->last_name. ', ' .$record->first_name. ' ' .$record->middle_name)
                    ->required()
                    ->visible(fn (string $operation): bool => $operation === 'create'),
                Placeholder::make('user_id_text')
                    ->label('Employee')
                    ->content(fn (Schedule $schedule): string => $schedule->user->full_name)
                    ->visible(fn (string $operation): bool => $operation === 'edit'),
                Select::make('time_of_shift')
                    ->options([
                        '6:00 AM - 5:00 PM' => '6:00 AM - 5:00 PM',
                        '8:00 AM - 7:00 PM' => '8:00 AM - 7:00 PM',
                        '7:00 PM - 6:00 AM' => '7:00 PM - 6:00 AM',
                        '9:00 PM - 8:00 AM' => '9:00 PM - 8:00 AM'
                    ])
                    ->required(),
                DatePicker::make('date_of_shift')
                    ->label('Date of shift')
                    ->format('Y-m-d')
                    ->required()
                    ->rules([ // Custom validation
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $employee_date_of_shift = Schedule::where('user_id', $get('user_id'))
                                ->where('date_of_shift', $value)
                                ->first();

                            if ($employee_date_of_shift) {
                                $fail('This employee already has a schedule for ' .Carbon::parse($get('date_of_shift'))->format('F j, Y'). '.');
                            }
                        },
                    ])
                    ->visible(fn (string $operation): bool => $operation === 'create'),
                Placeholder::make('date_of_shift_text')
                    ->label('Date of shift')
                    ->content(fn (Schedule $schedule): string => Carbon::parse($schedule->date_of_shift)->format('F j, Y'))
                    ->visible(fn (string $operation): bool => $operation === 'edit')
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListSchedules::route('/'), // Uses a custom view instead of Filament's view
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
