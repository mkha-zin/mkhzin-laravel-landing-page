<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicatorResource\Pages;
use App\Filament\Resources\ApplicatorResource\RelationManagers;
use App\Models\Applicator;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ApplicatorResource extends Resource
{
    protected static ?string $model = Applicator::class;

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
        return __('dashboard.join requests');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.join request');
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
                    ->words(3)
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('dashboard.phone'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->limit(10)
                    ->tooltip(fn(Applicator $record): string => $record->email)
                    ->searchable(),
                TextColumn::make('city')
                    ->label(__('dashboard.address'))
                    ->description(fn(Applicator $record): string => $record->district, position: 'above')
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('dashboard.description'))
                    ->tooltip(fn(Applicator $record): string => $record->description)
                    ->words(5),
                TextColumn::make('social_profiles')
                    ->listWithLineBreaks()
                    ->distinctList()
                    ->bulleted()
                    ->copyable()
                    ->expandableLimitedList(),
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
                IconColumn::make('cv_path')
                    ->label(__('dashboard.resume'))
                    ->tooltip(__('dashboard.Click to Download'))
                    ->alignCenter()
                    ->url(function ($record) {
                        $data['record'] = $record->cv_path;
                        $data['key'] = 'cv';
                        return route('joinus.download', $data);
                    })
                    ->color('primary')
                    ->icon('heroicon-s-document-arrow-down')
                    ->searchable(),
                IconColumn::make('license_path')
                    ->label(__('dashboard.license'))
                    ->tooltip(__('dashboard.Click to Download'))
                    ->alignCenter()->url(function ($record) {
                        $data['record'] = $record->license_path;
                        $data['key'] = 'license';
                        return route('joinus.download', $data);
                    })
                    ->color('primary')
                    ->icon('heroicon-s-arrow-down-circle')
                    ->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicators::route('/'),
        ];
    }
}
