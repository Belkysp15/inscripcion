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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login() // Activa la pantalla de acceso para Belkys y profesores
            
            // 1. COLORES INSTITUCIONALES (Lo que controla los botones de modo oscuro)
            ->colors([
                'primary' => '#004a99', // Azul UNESR: se verá en el icono seleccionado de tu foto
                'gray' => Color::Slate,  // Gris pizarra para un acabado profesional
            ])

            // 2. IDENTIDAD (Logo y Pestaña)
            ->brandName('UNESR - SGA VIRTUAL')
            ->brandLogo(asset('img/logo.png')) // Logo circular de la universidad
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('favicon.ico'))

            // 3. TIPOGRAFÍA (Misma del Welcome para que sea igualito)
            ->font('Plus Jakarta Sans')

            // 4. FUNCIONALIDADES DEL PANEL
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class, // El widget donde sale "Belkys" en tu foto
            ])

            // 5. CONFIGURACIÓN DE APARIENCIA
            ->darkMode(true) // Activa los iconos de Sol/Luna/Monitor que me pediste
            ->sidebarCollapsibleOnDesktop() // Menú lateral colapsable
            //->databaseNotifications() // Notificaciones en tiempo real
            
            // MIDDLEWARES DE SEGURIDAD
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
