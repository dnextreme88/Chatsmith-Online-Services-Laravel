<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

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
                    ->required(),
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
                    ->afterOrEqual('today')
                    ->unique(ignoreRecord: true, modifyRuleUsing: fn (Unique $rule, callable $get) =>
                        $rule->where('user_id', $get('user_id'))
                            ->where('date_of_shift', $get('date_of_shift'))
                    )
                    ->validationMessages(['unique' => 'This employee already has a shift at the specified date'])
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
