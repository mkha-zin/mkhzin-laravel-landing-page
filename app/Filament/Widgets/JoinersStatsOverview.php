<?php

namespace App\Filament\Widgets;

use App\Models\Joiner;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JoinersStatsOverview extends BaseWidget
{


    protected function getStats(): array
    {
        return [
            //all joiners stats
            Stat::make('Subscribers', Joiner::query()->count())
                ->label(__('dashboard.Subscribers'))
                ->description(__('dashboard.Subscribers Desc'))
                ->color('primary'),

            // all joiners stats last day
            Stat::make('Subscribers Last Day', Joiner::query()->where('created_at', '>=', now()->subDay())->count())
                ->label(__('dashboard.Subscribers Last Day'))
                ->description(__('dashboard.Subscribers Last Day Desc'))
                ->color('warning'),

            // all joiners stats last week
            Stat::make('Subscribers Last Week', Joiner::query()->where('created_at', '>=', now()->subWeek())->count())
                ->label(__('dashboard.Subscribers Last Week'))
                ->description(__('dashboard.Subscribers Last Week Desc'))
                ->color('success'),

            // all joiners stats last month
            Stat::make('Subscribers Last Month', Joiner::query()->where('created_at', '>=', now()->subMonth())->count())
                ->label(__('dashboard.Subscribers Last Month'))
                ->description(__('dashboard.Subscribers Last Month Desc'))
                ->color('danger'),
        ];
    }
}
