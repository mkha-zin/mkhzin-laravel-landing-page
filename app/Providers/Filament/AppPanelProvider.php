<?php

namespace App\Providers\Filament;

use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app')
            ->path('app')
            ->login()
            ->userMenuItems([
                    MenuItem::make('admin')
                        ->label(__('dashboard.Admin Panel'))
                        ->icon('heroicon-o-home')
                        ->color('primary')
                        ->url('/admin'),
                    MenuItem::make('rate')
                        ->label(__('dashboard.Rating Platform'))
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->url('https://rate.mkhzin.com/admin', shouldOpenInNewTab: true),
                    MenuItem::make('jobs')
                        ->label(__('dashboard.Jobs Portal'))
                        ->icon('heroicon-o-briefcase')
                        ->color('success')
                        ->url('/jobs-m'),
                ]
            )
            ->colors([
                'primary' => Color::hex('#E22128'),
            ])
            ->font('Cairo', provider: GoogleFontProvider::class)
            ->favicon(asset('uploads/mkhazin/fav.png'))
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->renderHook(
            // This line tells us where to render it
                PanelsRenderHook::FOOTER,
                // This is the view that will be rendered
                fn() => view('filament-panels::components.custom_footer'),
            )
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
