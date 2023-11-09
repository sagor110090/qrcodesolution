<?php

namespace App\Providers;

use App\Rules\IgnoreIfRule;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use Laravel\Cashier\Cashier;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { 




        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
