<?php

namespace App\Providers;

use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\AlpineComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // $this->app->bind('path.public', function () {
        //     return base_path('public_html');
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        FilamentAsset::register([
            // Css::make('leaflet-1-9-4-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'),
            Js::make('jquery-3-4-1-js', 'https://code.jquery.com/jquery-3.4.1.js'),
            Js::make('googlemap', "https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"),
            // AlpineComponent::make('visitor-heatmap-js', __DIR__ . '/../../resources/js/leaflet-heatmap.js'),
            // AlpineComponent::make('visitor-heatmap-js', 'https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js'),
        ]);
    }
}
