<?php

namespace App\Filament\Resources;

use App\Filament\Exports\JoinerExporter;
use App\Filament\Resources\JoinerResource\Pages;
use App\Filament\Resources\JoinerResource\RelationManagers;
use App\Models\Joiner;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JoinerResource extends Resource
{
    protected static ?string $model = Joiner::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.our customers');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.joiners');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.joiner');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('dashboard.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tiktok_user')
                    ->label(__('dashboard.tiktok_user'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('comment_image')
                    ->label(__('dashboard.comment_image')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('dashboard.deleted at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\ExportBulkAction::make()
                    ->exporter(JoinerExporter::class),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJoiners::route('/'),
            'create' => Pages\CreateJoiner::route('/create'),
            'view' => Pages\ViewJoiner::route('/{record}'),
            'edit' => Pages\EditJoiner::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
