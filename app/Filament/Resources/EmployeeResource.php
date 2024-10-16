<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\Pages\EditEmployee;
use App\Filament\Resources\EmployeeResource\Pages\ViewEmployee;
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
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
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

    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

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
                    ->icon(fn (int $state): string => match ($state) {
                        0 => 'heroicon-o-x-circle',
                        1 => 'heroicon-o-check-circle',
                    })
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'danger',
                        1 => 'success',
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
                        0 => 'Inactive',
                        1 => 'Active',
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Employee Details')
                    ->schema([
                        Split::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('id')
                                            ->label('Employee ID'),
                                        TextEntry::make('employee_number')
                                            ->label('Employee Number'),
                                        TextEntry::make('role'),
                                        IconEntry::make('user.is_staff')
                                            ->label('Is a Staff Member?')
                                            ->color(fn (int $state): string => match ($state) {
                                                0 => 'danger',
                                                1 => 'success'
                                            })
                                            ->icon(fn (int $state): string => match ($state) {
                                                0 => 'heroicon-o-x-circle',
                                                1 => 'heroicon-o-check-circle'
                                            })
                                    ]),
                                    Group::make([
                                        TextEntry::make('employee_type')
                                            ->label('Employee Type'),
                                        TextEntry::make('designation')
                                            ->label('Office Designation'),
                                        TextEntry::make('date_tenure')
                                            ->label('Date of Tenure')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                        IconEntry::make('is_active')
                                            ->label('Is an Active Member?')
                                            ->color(fn (int $state): string => match ($state) {
                                                0 => 'danger',
                                                1 => 'success'
                                            })
                                            ->icon(fn (int $state): string => match ($state) {
                                                0 => 'heroicon-o-x-circle',
                                                1 => 'heroicon-o-check-circle'
                                            })
                                    ]),
                                ]),
                            ImageEntry::make('user.profile_photo_url')
                                ->circular()
                                ->hiddenLabel()
                                ->grow(false)
                        ])
                    ]),
                Section::make('User Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('user.full_name')
                                    ->label('Full Name'),
                                TextEntry::make('user.email')
                                    ->label('Email'),
                                TextEntry::make('user.username')
                                    ->label('Username')
                            ])
                    ])
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewEmployee::class,
            EditEmployee::class
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
