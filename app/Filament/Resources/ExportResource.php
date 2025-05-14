<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExportResource\Pages;
use App\Models\Export;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ExportResource extends Resource
{
    protected static ?string $model = Export::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.others');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.exports');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.export');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('completed_at')
                    ->label(__('dashboard.completed at')),
                Forms\Components\TextInput::make('file_disk')
                    ->label(__('dashboard.file disk'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_name')
                    ->label(__('dashboard.file name'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('exporter')
                    ->label(__('dashboard.exporter'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('processed_rows')
                    ->label(__('dashboard.processed rows'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_rows')
                    ->label(__('dashboard.total rows'))
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('successful_rows')
                    ->label(__('dashboard.successful rows'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('user_id')
                    ->label(__('dashboard.user id'))
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('completed_at')
                    ->label(__('dashboard.completed at'))
                    ->dateTimeTooltip()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_disk')
                    ->label(__('dashboard.file disk'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_name')
                    ->label(__('dashboard.file name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('exporter')
                    ->label(__('dashboard.exporter'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('processed_rows')
                    ->label(__('dashboard.processed rows'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_rows')
                    ->label(__('dashboard.total rows'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('successful_rows')
                    ->label(__('dashboard.successful rows'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('dashboard.username'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label(__('dashboard.download'))
                    ->icon('heroicon-o-arrow-down-circle')
                    ->url(function ($record) {
                        $data['record'] = $record->file_name;
                        $data['key'] = $record->id;
                        return route('document.download', $data);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExports::route('/'),
        ];
    }
}
