<?php

namespace Webkul\GolobaTheme\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\Customer\Models\Customer as BaseCustomer;
use Webkul\GolobaTheme\Models\Customer;

class GolobaThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Publica vistas en caso de que se necesiten mover a resources
        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('themes/goloba-theme/views'),
        ]);

        // Carga rutas si existen
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        // Se agregan las traducciones customizadas ubicadas dentro del tema.
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/assets/marketplace/lang', 'marketplace');
	    $this->loadTranslationsFrom(__DIR__ . '/../Resources/assets/shop/lang', 'shop');
	    $this->loadTranslationsFrom(__DIR__ . '/../Resources/assets/admin/lang', 'admin');
        // Sobrescribe vistas de los paquetes
        $this->loadVendorViews();
	    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    protected function loadVendorViews()
    {
      	$this->loadViewsFrom(__DIR__.'/../Resources/views', 'goloba-theme');
    
        // Sobrescribir marketplace pero apuntando a la estructura correcta
        $this->app['view']->prependNamespace('marketplace', __DIR__ . '/../Resources/views/webkul/marketplace');
        
        $this->app['view']->prependNamespace('admin', __DIR__ . '/../Resources/views/webkul/admin');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/bagisto-vite.php',
            'bagisto-vite.viters'
        );

        // Registrar el modelo Customer personalizado
        $this->app->bind(BaseCustomer::class, Customer::class);
    }
}