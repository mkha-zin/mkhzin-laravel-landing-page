<?php

namespace App\Filament\App\Widgets;

use App\Models\AppScreen;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\StoreStep;
use App\Models\StoreText;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AppLandingOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('App Screens', AppScreen::query()->count())
                ->label(__('dashboard.app screens'))
                ->icon('heroicon-o-device-phone-mobile')
                ->url('/app/app-screens')
                ->description(__('dashboard.All App Screens in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Fuchsia),
            Stat::make('Brands', Brand::query()->count())
                ->label(__('dashboard.brands'))
                ->icon('heroicon-o-finger-print')
                ->url('/app/brands')
                ->description(__('dashboard.All brands in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Lime),
            Stat::make('Categories', Category::query()->count())
                ->label(__('dashboard.categories'))
                ->icon('heroicon-o-rectangle-stack')
                ->url('/app/categories')
                ->description(__('dashboard.All Categories in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Red),
            Stat::make('Features', Feature::query()->count())
                ->label(__('dashboard.features'))
                ->icon('heroicon-o-sparkles')
                ->url('/app/features')
                ->description(__('dashboard.All Features in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Orange),
            Stat::make('Shopping Steps', StoreStep::query()->count())
                ->label(__('dashboard.steps'))
                ->icon('heroicon-o-numbered-list')
                ->url('/app/store-steps')
                ->description(__('dashboard.All Shopping Steps in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Slate),
            Stat::make('Landing Texts', StoreText::query()->count())
                ->label(__('dashboard.store texts'))
                ->icon('heroicon-o-bars-3-center-left')
                ->url('/app/store-texts')
                ->description(__('dashboard.All Texts in the App Landing Page'))
                ->descriptionIcon('heroicon-m-star')
                ->chart([0, 0, 0, 0, 0, 0, 0])
                ->color(Color::Teal),
        ];
    }
}
