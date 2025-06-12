<?php

namespace App\Filament\Resources\SectionResource\Components;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class SectionInfolist
{
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__('dashboard.Image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.Image')),

            ])->columns(2),
            Section::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            Section::make(__('dashboard.descriptions'))->schema([
                TextEntry::make('description_ar')->label(__('dashboard.description_ar')),
                TextEntry::make('description_en')->label(__('dashboard.description_en')),
            ])->columns(2)
        ]);
    }
}
