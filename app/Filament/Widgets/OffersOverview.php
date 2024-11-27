<?php

namespace App\Filament\Widgets;

use App\Models\Offer;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OffersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        $offersCounts = Offer::whereBetween('start_date', [$startDate, $endDate])
            ->selectRaw('DATE(start_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $dates = [];
        foreach (Carbon::parse($startDate)->daysUntil($endDate) as $date) {
            $dates[$date->format('Y-m-d')] = $offersCounts[$date->format('Y-m-d')] ?? 0;
        }

        $yearStartDate = Carbon::now()->subYear()->startOfYear();
        $yearEndDate = Carbon::now()->subYear()->endOfYear();

        $yearEmployeeCounts = Offer::whereBetween('start_date', [$yearStartDate, $yearEndDate])
            ->selectRaw('DATE(start_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $yearDates = [];
        foreach (Carbon::parse($yearStartDate)->daysUntil($yearEndDate) as $date) {
            $yearDates[$date->format('Y-m-d')] = $yearEmployeeCounts[$date->format('Y-m-d')] ?? 0;
        }

        return [
            Stat::make('Offers', Offer::query()->count())
                ->label(__('dashboard.offers'))
                ->icon('heroicon-o-gift')
                ->url('/admin/offers')
                ->description(__('dashboard.All Offers in the database'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Offers', array_sum($dates))
                ->label(__('dashboard.Last month Offers'))
                ->icon('heroicon-o-gift')
                ->description(__('dashboard.Offers in the last month'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(array_values($dates))
                ->color('warning'),
            Stat::make('Offers', array_sum($yearDates))
                ->label(__('dashboard.Last year Offers'))
                ->icon('heroicon-o-gift')
                ->description(__('dashboard.Offers in the last year'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(array_values($yearDates))
                ->color(Color::Sky),
        ];
    }
}
