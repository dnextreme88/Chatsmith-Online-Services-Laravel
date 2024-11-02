<?php

namespace App\Filament\Resources;

use App\Enums\RequestStatuses;
use App\Enums\RequestTypes;
use App\Filament\Resources\FormRequestResource\Pages;
use App\Filament\Resources\FormRequestResource\RelationManagers;
use App\Models\FormRequest;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class FormRequestResource extends Resource
{
    protected static ?string $model = FormRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $activeNavigationIcon = 'heroicon-s-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.full_name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('checked_by_full_name')
                    ->label('Checked by')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reason')
                    ->searchable()
                    ->words(10),
                TextColumn::make('request_type'),
                TextColumn::make('request_status')
                    ->badge()
                    ->color(fn (RequestStatuses $state): string => match ($state) {
                        RequestStatuses::APPROVED => 'success',
                        RequestStatuses::PENDING => 'warning',
                        RequestStatuses::REJECTED => 'danger',
                        default => 'gray'
                    }),
                TextColumn::make('date_from')
                    ->label('Dates Covered')
                    ->formatStateUsing(fn (FormRequest $record) =>
                        Carbon::parse($record->date_from)->toFormattedDateString(). ' ~ ' .Carbon::parse($record->date_to)->toFormattedDateString()
                    )
            ])
            ->filters([
                SelectFilter::make('request_type')
                    ->options(RequestTypes::class),
                SelectFilter::make('request_status')
                    ->options(RequestStatuses::class),
                Filter::make('date')
                    ->form([
                        DatePicker::make('date_from')
                            ->label('Date (from)'),
                        DatePicker::make('date_to')
                            ->label('Date (to)')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('date_from', '>=', $date)
                            )
                            ->when(
                                $data['date_to'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('date_to', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['date_from']) {
                            $indicators['date_from'] = 'Date from: ' .Carbon::parse($data['date_from'])->toFormattedDateString();
                        }

                        if ($data['date_to']) {
                            $indicators['date_to'] = 'Date to: ' .Carbon::parse($data['date_to'])->toFormattedDateString();
                        }

                        return $indicators;
                    })
            ])
            ->actions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->tooltip('Approve request')
                    ->requiresConfirmation()
                    ->modalHeading('Approve request?')
                    ->modalDescription('Are you sure you would like to approve this request?')
                    ->hidden(fn (FormRequest $record): bool => $record->request_status != RequestStatuses::PENDING)
                    ->action(function (FormRequest $record) {
                        $record->checked_by_employee_id = Auth::user()->employee->id;
                        $record->request_status = RequestStatuses::APPROVED;

                        $record->save();
                        // TODO: TO ADD NOTIFICATION TO USER THAT THEIR REQUEST WAS APPROVED
                    }),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->tooltip('Reject request')
                    ->requiresConfirmation()
                    ->modalHeading('Reject request?')
                    ->modalDescription('Are you sure you would like to reject this request?')
                    ->hidden(fn (FormRequest $record): bool =>$record->request_status != RequestStatuses::PENDING)
                    ->action(function (FormRequest $record) {
                        $record->checked_by_employee_id = Auth::user()->employee->id;
                        $record->request_status = RequestStatuses::REJECTED;

                        $record->save();
                        // TODO: TO ADD NOTIFICATION TO USER THAT THEIR REQUEST WAS REJECTED
                    }),
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
        return ['index' => Pages\ListFormRequests::route('/')];
    }
}
