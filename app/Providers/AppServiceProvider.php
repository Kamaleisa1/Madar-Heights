<?php

namespace App\Providers;

use App\Support\DbTranslationLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Interface texts can be overridden from the dashboard
        $this->app->extend('translation.loader', fn ($loader) => new DbTranslationLoader($loader));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
