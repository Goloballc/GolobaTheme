<?php

namespace Webkul\GolobaTheme\Providers;

use Illuminate\Support\ServiceProvider;

class GolobaThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Service provider code will be added here
        $this->publishes([
        __DIR__.'/../Resources/views'  => resource_path('themes/goloba-theme/views'),
    ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}