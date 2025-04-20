<?php

namespace App\Filament\Jobs\Widgets;

use App\Models\Application;
use App\Models\Career;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JobsStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $jobsCount = Career::count();
        $applicationsCount = Application::count();

        $average = $jobsCount > 0 ? round($applicationsCount / $jobsCount, 2) : 0;

        return [
            Stat::make(__('dashboard.Published Jobs'), $jobsCount)
                ->description(__('dashboard.Total job postings'))
                ->color('success')
                ->chart([35, 40, 32, 51, 42, 82, 53])
                ->chartColor('success')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->icon('heroicon-o-briefcase')
                ->url('/jobs-m/careers'),
            Stat::make(__('dashboard.Total Applicants'), $applicationsCount)
                ->description(__('dashboard.Number of applications'))
                ->color('info')
                ->chart([65, 59, 80, 81, 56, 55, 40])
                ->chartColor('info')
                ->descriptionIcon('heroicon-m-user-group')
                ->icon('heroicon-o-user-group')
                ->url('/jobs-m/applications'),
            Stat::make(__('dashboard.Applicants Ratio'), $average)
                ->description(__('dashboard.Avg. Applicants per Job'))
                ->color('warning')
                ->chart([21, 42, 13, 18, 4, 17, 35])
                ->chartColor('warning')
                ->descriptionIcon('heroicon-m-percent-badge')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
