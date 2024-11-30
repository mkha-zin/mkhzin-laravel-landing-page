<?php

namespace App\Filament\Widgets;

use App\Models\Branch;
use App\Models\City;
use App\Models\Section;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BranchesAndSections extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Branches', Branch::query()->count())
                ->label(__('dashboard.branches'))
                ->icon('heroicon-o-building-storefront')
                ->url('/admin/branches')
                ->description(__('dashboard.All Branches in the database'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0,0,0,0,0,0,0])
                ->color(Color::hex('#21AB71')),
            Stat::make('Sections', Section::query()->count())
                ->label(__('dashboard.sections'))
                ->icon('heroicon-o-shopping-cart')
                ->url('/admin/sections')
                ->description(__('dashboard.All Sections in the database'))
                ->descriptionIcon('heroicon-m-fire')
                ->chart([0,0,0,0,0,0,0])
                ->color(Color::hex('#F08650')),
            Stat::make('Cities', City::query()->count())
                ->label(__('dashboard.cities'))
                ->icon('heroicon-o-map-pin')
                ->url('/admin/cities')
                ->description(__('dashboard.All Cities in the database'))
                ->descriptionIcon('heroicon-m-megaphone')
                ->chart([0,0,0,0,0,0,0])
                ->color(Color::hex('#CD37D9')),
        ];
    }
}
