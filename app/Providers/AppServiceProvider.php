<?php

namespace App\Providers;

use App\Rules\IgnoreIfRule;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
        Validator::extend('ignore_if', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            if (strpos($otherField, '.') !== false) {
                $otherValue = data_get($validator->getData(), $otherField);
            } else {
                $otherValue = $validator->getData()[$otherField];
            }
            dd($otherField);

            if ($otherValue === false || $otherValue === null) {
                return true;
            }
            return $value !== null;
        }, 'The :attribute field is required.');



        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
