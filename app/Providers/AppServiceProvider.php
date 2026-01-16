<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prefetch de assets con concurrencia
        Vite::prefetch(concurrency: 3);

        // Usar el archivo hot para desarrollo (vite dev server)
        Vite::useHotFile(public_path('hot'));

        // Directorio de build para producción
        Vite::useBuildDirectory('build');

        // Compartir el usuario autenticado con Inertia
        Inertia::share([
            'auth' => fn () => [
                'user' => Auth::user(),
            ],
        ]);
    }
}
