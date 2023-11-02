<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;

class FolioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Folio::domain('admin.' . config('app.domain'))
            ->path(resource_path('views/pages/admin'));
        Folio::domain('app.' . config('app.domain'))
            ->path(resource_path('views/pages/user'));
        Folio::domain(config('app.domain'))
            ->path(resource_path('views/pages/guest'));
        Folio::domain(config('app.domain'))
            ->path(resource_path('views/pages/dynamic'));
        Folio::domain('app.' . config('app.domain'))
            ->path(resource_path('views/pages/dynamic'));
    }
}
