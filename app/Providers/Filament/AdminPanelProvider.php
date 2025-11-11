<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Models\Producto;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tienda de Abarrotes es un negocio familiar con raíces profundas en la comunidad de Nuevo Chimbote. Desde nuestros inicios en 2012, nos hemos dedicado a ofrecer productos de calidad, atención cercana y precios justos para todas las familias del barrio.
Creemos que una tienda de abarrotes no es solo un lugar para comprar, sino un punto de encuentro donde se construyen relaciones de confianza. Nuestro compromiso es brindar un servicio cálido, rápido y eficiente, con una sonrisa siempre lista para recibirte.
Nos especializamos en productos de primera necesidad: alimentos, bebidas, artículos de limpieza, cuidado personal y más. Trabajamos con marcas reconocidas y proveedores locales para asegurar frescura, variedad y abastecimiento constante.', Producto::count()),

        ];
    }

    protected int|string|array $columnSpan = 'full';
}


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
    Widgets\AccountWidget::class,
    Widgets\FilamentInfoWidget::class,
    ProductStatsWidget::class, // 👈 nuevo widget agregado
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ;
    }
}
