<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use Awcodes\Curator\CuratorPlugin;
use Awcodes\FilamentGravatar\GravatarPlugin;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use Exception;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use LaraZeus\Delia\DeliaPlugin;
use LaraZeus\Delia\Filament\Resources\BookmarkResource;
use LaraZeus\Delia\Models\Bookmark;
use Pboivin\FilamentPeek\FilamentPeekPlugin;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
//            ->registration()
            ->colors([
                'primary' => Color::hex('#E22128'),
            ])
            ->plugins([
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: false,
                        hasAvatars: false,
                        navigationGroup: __('dashboard.others'),
                    )->enableTwoFactorAuthentication(),
                DeliaPlugin::make()
                    ->models([
                        'User' => config('auth.providers.users.model'),
                        'Bookmark' => Bookmark::class,
                    ])
                    ->navigationGroupLabel('Delia')
                    ->hideResources([
                        BookmarkResource::class,
                    ])
            ])
            ->font('Cairo', provider: GoogleFontProvider::class)
            ->favicon(asset('uploads/mkhazin/fav.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->brandName(__('dashboard.app_name'))
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
//                Widgets\AccountWidget::class,
            ])
            ->renderHook(
            // This line tells us where to render it
                'panels::body.end',
                // This is the view that will be rendered
                fn () => view('filament-panels::components.custom_footer'),
            )
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
