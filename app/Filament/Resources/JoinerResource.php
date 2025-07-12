<?php

namespace App\Filament\Resources;

use App\Filament\Exports\JoinerExporter;
use App\Filament\Resources\JoinerResource\Pages;
use App\Filament\Resources\JoinerResource\RelationManagers;
use App\Models\Joiner;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
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
                TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('dashboard.phone'))
                    ->searchable(),
                TextColumn::make('tiktok_user')
                    ->label(__('dashboard.tiktok_user'))
                    ->searchable(),
                ImageColumn::make('comment_image')
                    ->label(__('dashboard.comment_image')),
                IconColumn::make('deleted_at')
                    ->label(__('dashboard.deleted'))
                    ->icon(fn($record) => $record->deleted_at ? 'heroicon-s-trash' : '')
                    ->color(fn($record) => $record->deleted_at ? 'danger' : '')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make()->default('withTrashed'),
            ])
            ->actions([
                ViewAction::make()->button()->size(ActionSize::ExtraSmall),
                RestoreAction::make()->button()->size(ActionSize::ExtraSmall),
                DeleteAction::make()->button()->size(ActionSize::ExtraSmall),
                ForceDeleteAction::make()->button()->size(ActionSize::ExtraSmall),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->exporter(JoinerExporter::class),
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make([
                TextEntry::make('name')
                    ->label(__('dashboard.name')),
                TextEntry::make('phone')
                    ->label(__('dashboard.phone')),
                TextEntry::make('tiktok_user')
                    ->label(__('dashboard.tiktok_user')),
                ImageEntry::make('comment_image')
                    ->label(__('dashboard.comment_image'))
                    ->columnSpanFull(),
            ])->columns(2)
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJoiners::route('/'),
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
