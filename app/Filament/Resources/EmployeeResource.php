<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->required()
                    ->options(User::selectRaw('id, CONCAT(COALESCE(`first_name`, ""), " ", COALESCE(`maiden_name`, ""), " ", COALESCE(`last_name`, "")) AS user_full_name')
                        ->doesntHave('employee')
                        ->get()
                        ->pluck('user_full_name', 'id') // Using ->pluck('full_name', 'id') fails as it is an accessor function in App\Models\User
                    )
                    ->helperText('Only users that have registered but are not yet considered employees will show up here')
                    ->hidden(fn (string $operation): bool => $operation === 'edit'),
                Placeholder::make('user_id')
                    ->label('User')
                    ->content(fn (Employee $employee): string => $employee->user->full_name)
                    ->hidden(fn (string $operation): bool => $operation === 'create'),
                TextInput::make('employee_number')
                    ->required()
                    ->unique(table: Employee::class, ignoreRecord: true),
                Select::make('employee_type')
                    ->label('Employee Type')
                    ->required()
                    ->options([
                        'OJT' => 'OJT',
                        'Part-time' => 'Part-time',
                        'Regular' => 'Regular'
                    ]),
                Select::make('designation')
                    ->label('Office Designation')
                    ->required()
                    ->options([
                        'Baguio' => 'Baguio',
                        'Pangasinan' => 'Pangasinan'
                    ]),
                Select::make('role')
                    ->required()
                    ->options([
                        'Administrator' => 'Administrator',
                        'Director' => 'Director',
                        'Employee' => 'Employee',
                        'Human Resources and Recruitment' => 'Human Resources and Recruitment',
                        'Owner' => 'Owner',
                        'Quality Analyst' => 'Quality Analyst',
                        'Supervisor' => 'Supervisor',
                        'Team Leader' => 'Team Leader'
                    ]),
                DatePicker::make('date_tenure'),
                Checkbox::make('is_active')
                    ->hidden(fn (string $operation): bool => $operation === 'create')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_number')
                    ->label('Employee #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.full_name')
                    ->label('Full Name')
                    ->searchable(['first_name', 'maiden_name', 'last_name'])
                    ->sortable(['first_name']),
                TextColumn::make('employee_type'),
                TextColumn::make('designation'),
                TextColumn::make('role'),
                TextColumn::make('date_tenure')
                    ->label('Date of Tenure')
                    ->dateTime('m/d/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->label('Is Active?')
                    ->icon(fn (string $state): string => match ($state) {
                        'True' => 'heroicon-o-check-circle',
                        'False' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'True' => 'success',
                        'False' => 'danger',
                        default => 'gray'
                    })
            ])
            ->filters([
                SelectFilter::make('employee_type')
                    ->label('Employee Type')
                    ->options([
                        'OJT' => 'OJT',
                        'Part-time' => 'Part-time',
                        'Regular' => 'Regular'
                    ]),
                SelectFilter::make('designation')
                    ->options([
                        'Baguio' => 'Baguio',
                        'Pangasinan' => 'Pangasinan'
                    ]),
                SelectFilter::make('role')
                    ->options([
                        'Administrator' => 'Administrator',
                        'Director' => 'Director',
                        'Employee' => 'Employee',
                        'Human Resources and Recruitment' => 'Human Resources and Recruitment',
                        'Owner' => 'Owner',
                        'Quality Analyst' => 'Quality Analyst',
                        'Supervisor' => 'Supervisor',
                        'Team Leader' => 'Team Leader'
                    ]),
                SelectFilter::make('is_active')
                    ->label('Is an active employee?')
                    ->options([
                        'True' => 'Active',
                        'False' => 'Inactive'
                    ])
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->successNotificationTitle('Employee deleted')
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
