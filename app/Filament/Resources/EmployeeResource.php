<?php

namespace App\Filament\Resources;

use App\Enums\EmployeeRoles;
use App\Enums\EmployeeTypes;
use App\Enums\OfficeDesignations;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\Pages\EditEmployee;
use App\Filament\Resources\EmployeeResource\Pages\EmployeeTasks;
use App\Filament\Resources\EmployeeResource\Pages\ViewEmployee;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section AS FormSection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
use Filament\Tables\Filters\Filter;
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
                FormSection::make('Employee Details')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->required()
                            ->options(User::selectRaw('id, CONCAT(COALESCE(`last_name`, ""), ", ", COALESCE(`first_name`, ""), " ", COALESCE(`maiden_name`, "")) AS employee_name')
                                ->doesntHave('employee')
                                ->get()
                                ->pluck('employee_name', 'id') // Using ->pluck('full_name', 'id') fails as it is an accessor function in App\Models\User
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
                            ->required()
                            ->options(EmployeeTypes::class),
                        Select::make('designation')
                            ->label('Office designation')
                            ->required()
                            ->options(OfficeDesignations::class),
                        Select::make('role')
                            ->required()
                            ->options(EmployeeRoles::class),
                        DatePicker::make('date_hired'),
                        Checkbox::make('is_active')
                            ->live()
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                        DatePicker::make('date_resigned')
                            ->visible(fn (Get $get): bool => !$get('is_active'))
                            ->afterOrEqual('date_hired')
                    ])
                    ->columns(2),
                FormSection::make('Contribution Details')
                    ->schema([
                        TextInput::make('pag_ibig_number')
                            ->label('Pag-IBIG Number'),
                        TextInput::make('philhealth_number')
                            ->label('PhilHealth Number'),
                        TextInput::make('sss_number')
                            ->label('SSS Number')
                    ])
                    ->columns(3)
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
                    ->label('Full name')
                    ->searchable(['first_name', 'maiden_name', 'last_name'])
                    ->sortable(['first_name']),
                TextColumn::make('employee_type'),
                TextColumn::make('designation')
                    ->label('Office designation')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('role'),
                TextColumn::make('date_hired')
                    ->dateTime('m/d/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_resigned')
                    ->dateTime('m/d/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_staff')
                    ->label('Is a staff member?')
                    ->icon(fn (int $state): string => match ($state) {
                        0 => 'heroicon-o-x-circle',
                        1 => 'heroicon-o-check-circle',
                    })
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'danger',
                        1 => 'success',
                        default => 'gray'
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->label('Is an active employee?')
                    ->icon(fn (int $state): string => match ($state) {
                        0 => 'heroicon-o-x-circle',
                        1 => 'heroicon-o-check-circle',
                    })
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'danger',
                        1 => 'success',
                        default => 'gray'
                    }),
                TextColumn::make('pag_ibig_number')
                    ->label('Pag-IBIG Number'),
                TextColumn::make('philhealth_number')
                    ->label('PhilHealth Number'),
                TextColumn::make('sss_number')
                    ->label('SSS Number')
            ])
            ->filters([
                SelectFilter::make('employee_type')
                    ->options(EmployeeTypes::class),
                SelectFilter::make('designation')
                    ->label('Office designation')
                    ->options(OfficeDesignations::class),
                SelectFilter::make('role')
                    ->options(EmployeeRoles::class),
                Filter::make('active')
                    ->default()
                    ->label('Show active employees')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', 1))
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
                                        TextEntry::make('employee_number'),
                                        TextEntry::make('user.username')
                                            ->label('Username'),
                                        TextEntry::make('user.email')
                                            ->label('Email'),
                                        TextEntry::make('role'),
                                        TextEntry::make('employee_type')
                                    ]),
                                    Group::make([
                                        TextEntry::make('designation')
                                            ->label('Office designation'),
                                        IconEntry::make('is_staff')
                                            ->label('Is a staff member?')
                                            ->color(fn (int $state): string => match ($state) {
                                                0 => 'danger',
                                                1 => 'success'
                                            })
                                            ->icon(fn (int $state): string => match ($state) {
                                                0 => 'heroicon-o-x-circle',
                                                1 => 'heroicon-o-check-circle'
                                            }),
                                        IconEntry::make('is_active')
                                            ->label('Is an active employee?')
                                            ->color(fn (int $state): string => match ($state) {
                                                0 => 'danger',
                                                1 => 'success'
                                            })
                                            ->icon(fn (int $state): string => match ($state) {
                                                0 => 'heroicon-o-x-circle',
                                                1 => 'heroicon-o-check-circle'
                                            }),
                                        TextEntry::make('date_hired')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                        TextEntry::make('date_resigned')
                                            ->badge()
                                            ->date()
                                            ->color('danger')
                                    ])
                                ]),
                            ImageEntry::make('user.profile_photo_url')
                                ->circular()
                                ->hiddenLabel()
                                ->grow(false)
                        ])
                    ]),
                Section::make('Contribution Details')
                    ->schema([
                        TextEntry::make('pag_ibig_number')
                            ->label('Pag-IBIG Number'),
                        TextEntry::make('philhealth_number')
                            ->label('PhilHealth Number'),
                        TextEntry::make('sss_number')
                            ->label('SSS Number')
                    ])
                    ->columns(3),
                Section::make('User Details')
                    ->schema([
                        TextEntry::make('user.full_name')
                            ->label('Full Name'),
                        TextEntry::make('user.phone_number')
                            ->label('Phone Number'),
                        TextEntry::make('user.address')
                            ->label('Address')
                    ])
                    ->columns(3)
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            EditEmployee::class,
            ViewEmployee::class,
            EmployeeTasks::class
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
            'edit' => EditEmployee::route('/{record}/edit'),
            'view' => ViewEmployee::route('/{record}'),
            'tasks' => EmployeeTasks::route('/{record}/tasks'),
        ];
    }
}
