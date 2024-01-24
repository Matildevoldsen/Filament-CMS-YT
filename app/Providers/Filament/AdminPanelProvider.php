<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Pages\Home;
use Filament\Support\Colors\Color;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\StockResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\CategoryResource;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use App\Filament\Resources\NavigationResource;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Resources\ShippingTypeResource;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make(),
                SpotlightPlugin::make(),
            ])
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->spa()
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('Shop')->items([
                        ...OrderResource::getNavigationItems(),
                        ...ProductResource::getNavigationItems(),
                        ...StockResource::getNavigationItems(),
                        ...ShippingTypeResource::getNavigationItems(),
                    ]),
                    NavigationGroup::make('Content')->items([
                        ...PostResource::getNavigationItems(),
                        ...CategoryResource::getNavigationItems(),
                        ...NavigationResource::getNavigationItems()
                    ]),
                    NavigationGroup::make('Users & Roles')->items([
                        ...UserResource::getNavigationItems()
                    ])
                ]);
            })
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
