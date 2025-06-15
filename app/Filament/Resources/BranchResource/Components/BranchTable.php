<?php

namespace App\Filament\Resources\BranchResource\Components;

use App\Models\Branch;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class BranchTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->filters([
                    SelectFilter::make('city')
                        ->relationship('city', App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                        ->label(__('dashboard.city'))
                        ->columnSpan(2)
                ]
                , layout: FiltersLayout::AboveContentCollapsible)
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )
                    ->label(__('dashboard.city'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('type')
                    ->label(__('dashboard.type'))
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        return $record->type === 'super'
                            ? __('dashboard.super')
                            : ($record->type === 'hyper'
                                ? __('dashboard.hyper')
                                : __('dashboard.wholesale'));
                    })
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'address_ar' : 'address_en'
                )
                    ->label(__('dashboard.address'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('snapchat')
                    ->label(__('dashboard.snapchat'))
                    ->icon(asset('images/icons/snapchat.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->snapchat) ? $record->snapchat : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('instagram')
                    ->label(__('dashboard.instagram'))
                    ->icon(asset('images/icons/instagram.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->instagram) ? $record->instagram : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('tiktok')
                    ->label(__('dashboard.tiktok'))
                    ->icon(asset('images/icons/tik-tok.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->tiktok) ? $record->tiktok : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('longitude')
                    ->label(__('dashboard.coordinates'))
                    ->description(fn(Branch $record) => $record->latitude)
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->label(__('dashboard.Image'))
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->actions([
                ViewAction::make()->iconButton()->icon('heroicon-o-building-storefront'),
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

}
