<?php

namespace App\Filament\Resources\OfferResource\Components;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\App;

class OffersInfolist
{
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            InfoSection::make()->schema([
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )->label(__('dashboard.branch')),
            ])->columns(2),
            InfoSection::make(__('dashboard.Image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.Image')),
                TextEntry::make('pdf_file')
                    ->label(__('dashboard.file')),
            ])->columns(2),
            InfoSection::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
            ])->columns(2),
            InfoSection::make(__('dashboard.description'))->schema([
                TextEntry::make('description_ar')->label(__('dashboard.description_ar'))->markdown(),
                TextEntry::make('description_en')->label(__('dashboard.description_en'))->markdown(),
            ])->columns(2),
            InfoSection::make(__('dashboard.duration'))->schema([
                TextEntry::make('start_date')->label(__('dashboard.start_date'))->dateTime(format: 'D d/M/Y h:i A'),
                TextEntry::make('end_date')->label(__('dashboard.end_date'))->dateTime(format: 'D d/M/Y h:i A'),
            ])->columns(2)
        ]);
    }
}
