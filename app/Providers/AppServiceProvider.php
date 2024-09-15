<?php

namespace App\Providers;

use Carbon\Carbon;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

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
        //
        FilamentAsset::register([
            Css::make('custom-filament', __DIR__ . '/../../resources/css/custom-filament.css')
        ]);
    }
}
