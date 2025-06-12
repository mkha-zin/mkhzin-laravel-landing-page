<?php

namespace App\Filament\Resources\BranchResource\Components;

use App\Models\Branch;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\App;

class BranchInfolist
{
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            InfoSection::make(__('dashboard.details'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.Image')),
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )->label(__('dashboard.city')),
                TextEntry::make('type')->label(__('dashboard.type')),
            ])->columns(3),
            InfoSection::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
                TextEntry::make('description_ar')->label(__('dashboard.description_ar'))->markdown(),
                TextEntry::make('description_en')->label(__('dashboard.description_en'))->markdown(),
            ])->columns(2),
            InfoSection::make(__('dashboard.addresses'))->schema([
                TextEntry::make('address_ar')->label(__('dashboard.address_ar')),
                TextEntry::make('address_en')->label(__('dashboard.address_en')),
                TextEntry::make('longitude')->label(__('dashboard.longitude')),
                TextEntry::make('latitude')->label(__('dashboard.latitude')),
            ])->columns(2),
            InfoSection::make(__('dashboard.social_link'))->schema([
                TextEntry::make('snapchat')
                    ->label(__('dashboard.snapchat'))
                    ->url(fn(Branch $record) => $record->snapchat, true),
                TextEntry::make('instagram')
                    ->label(__('dashboard.instagram'))
                    ->url(fn(Branch $record) => $record->instagram, true),
                TextEntry::make('tiktok')
                    ->label(__('dashboard.tiktok'))
                    ->url(fn(Branch $record) => $record->tiktok, true),
            ])->columns(3),
        ]);
    }

}
