<?php

namespace App\Filament\Resources;

use App\Filament\Exports\SubscriptionExporter;
use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.contactSettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.subscriptions');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.subscriptions');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return 'email';
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                ExportBulkAction::make()
                    ->exporter(SubscriptionExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
                    ->fileDisk('public')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->fileName(fn(Export $export): string => "subscriptions-{$export->getKey()}"),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            InfoSection::make()->schema([
                TextEntry::make('email')->label(__('dashboard.email')),
            ])->columns(2),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make()
        ];
    }
}
