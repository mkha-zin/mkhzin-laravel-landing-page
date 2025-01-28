<?php

namespace App\Providers;

use App\Services\DataFetcherService;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DataFetcherService::class, function ($app) {
            return new DataFetcherService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(static function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en'])
                ->flags([
                    'ar' => asset('images/svg/flags/ar.svg'),
                    'en' => asset('images/svg/flags/en.svg'),
                ])
//                    ->circular()
                ->labels([
                    'ar' => 'العربية (AR)',
                    'en' => 'English (EN)',
                ]);
        });

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(__('dashboard.servicesManagement'))
                    ->icon('heroicon-o-wrench-screwdriver'),
                NavigationGroup::make()
                    ->label(__('dashboard.aboutCompanySettings'))
                    ->icon('heroicon-o-building-office-2'),
                NavigationGroup::make()
                    ->label(__('dashboard.pageManagement'))
                    ->icon('heroicon-o-computer-desktop'),
                NavigationGroup::make()
                    ->label(__('dashboard.contactSettings'))
                    ->icon('heroicon-o-chat-bubble-left-right'),
                NavigationGroup::make()
                    ->label(__('dashboard.others'))
                    ->icon('heroicon-o-adjustments-horizontal'),
                NavigationGroup::make()
                    ->label(__('dashboard.Settings'))
            ]);
        });
    }
}
