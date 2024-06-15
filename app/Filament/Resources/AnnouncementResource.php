<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Announcement Details')
                    ->schema([
                        Placeholder::make('user_id')
                            ->label('Author')
                            ->content(User::findOrFail(auth()->id())->full_name),
                        TextInput::make('title')
                            ->required()
                            ->unique(ignoreRecord: true),
                        MarkdownEditor::make('description')
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->columnSpan(2)
                    ])
                    ->columnSpan(fn (string $operation): int => $operation === 'create' ? 3 : 2)
                    ->columns(2),
                Section::make('Time')
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Announced on')
                            ->content(fn (Announcement $announcement): string => $announcement->created_at->isoFormat('LLL')),
                        Placeholder::make('updated_at')
                            ->label('Updated on')
                            ->content(fn (Announcement $announcement): string => $announcement->updated_at->isoFormat('LLL'))
                    ])
                    ->hidden(fn (string $operation): bool => $operation === 'create')
                    ->columnSpan(1)
                    ->columns(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.full_name')
                    ->label('Author')
                    ->searchable(['first_name', 'maiden_name', 'last_name'])
                    ->sortable(['first_name']),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->words(5),
                TextColumn::make('created_at')
                    ->label('Announced on')
                    ->sortable()
                    ->dateTime('m/d/Y H:m:s'),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime('m/d/Y H:m:s'),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->options(User::selectRaw('id, CONCAT(COALESCE(`first_name`, ""), " ", COALESCE(`last_name`, "")) AS author_name')
                        ->whereRaw('is_staff = "True"')
                        ->get()
                        ->pluck('author_name', 'id') // Using ->pluck('full_name', 'id') fails as it is an accessor function in App\Models\User
                    )
                    ->query(function (Builder $query, array $data) {
                        // REF: https://v2.filamentphp.com/tricks/use-selectfilter-on-distant-relationships
                        if (!empty($data['value'])) {
                            return $query->whereHas('user',
                                fn (Builder $query) => $query->where('id', '=', (int) $data['value'])
                            );
                        }
                    })
                    ->label('Author'),
            ])
            ->actions([
                EditAction::make()
                    ->visible(function ($record): bool {
                        $visible = $record->user_id == auth()->id();

                        return $visible;
                    }),
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
            'index' => Pages\ListAnnouncement::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
