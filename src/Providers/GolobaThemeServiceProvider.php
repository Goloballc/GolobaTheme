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

    $this->loadVendorViews();
    }

    /**
     * Load vendor package views override
     */
    protected function loadVendorViews()
    {
        $this->app['view']->prependNamespace('marketplace', __DIR__ . '/../Resources/views/webkul/marketplace');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(
        dirname(__DIR__).'/Config/bagisto-vite.php',
        'bagisto-vite.viters'
    );
    }
}