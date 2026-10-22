<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use App\Filament\Support\InitialsAvatar;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\Support\Icons\Heroicon;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('مدار هايتس')
            ->brandLogo(fn () => asset('assets/img/logo.png'))
            ->darkModeBrandLogo(fn () => asset('assets/img/logo-dark.png'))
            ->brandLogoHeight('3.2rem')
            ->favicon(fn () => asset('favicon.png'))
            ->font('Tajawal')
            ->defaultAvatarProvider(InitialsAvatar::class)
            ->colors([
                // Royal blue from the logo (explicit shades so buttons stay deep blue)
                'primary' => [
                    50 => '#EEF4FF', 100 => '#DCE7FD', 200 => '#B9CFFB', 300 => '#8CAEF5',
                    400 => '#3B7BF0', 500 => '#1E63E9', 600 => '#1456D6', 700 => '#0B3D91',
                    800 => '#082F72', 900 => '#061F4F', 950 => '#041533',
                ],
                'warning' => Color::Amber,
            ])
            ->navigationItems([
                NavigationItem::make('عرض الموقع')
                    ->url(fn () => url('/'), shouldOpenInNewTab: true)
                    ->icon(Heroicon::OutlinedGlobeAlt)
                    ->sort(100),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
