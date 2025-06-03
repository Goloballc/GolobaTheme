# Personalización de Vistas y Assets de Paquetes Vendor en GolobaTheme

Esta guía explica cómo personalizar las vistas y assets de paquetes vendor (Marketplace, PayPal, Social Login, etc.) en tu tema GolobaTheme de Bagisto.

## Problema que resuelve

Cuando usas paquetes vendor oficiales de Webkul, es común encontrar referencias como:
- `marketplace::components.shop.layouts.header.style`
- `marketplace::components.shop.layouts.header.sell`
- `paypal::checkout.onepage.payment-button`

Estas referencias aparecen como texto plano en lugar del contenido renderizado porque el tema no tiene las vistas personalizadas para estos paquetes.

## Requisitos previos

- Tema GolobaTheme instalado y funcionando
- Paquete vendor instalado (ej: Marketplace, PayPal, etc.)
- Node.js y npm instalados

## Proceso paso a paso

### 1. Identificar el paquete a personalizar

Localiza el paquete en:
```
packages/Webkul/[NombrePaquete]/
```

Ejemplos:
- `packages/Webkul/Marketplace/`
- `packages/Webkul/Paypal/`
- `packages/Webkul/SocialLogin/`

### 2. Examinar la estructura de vistas del paquete

Navega a:
```
packages/Webkul/[NombrePaquete]/src/Resources/views/
```

Identifica las vistas que aparecen como texto plano en tu sitio.

### 3. Crear estructura de directorios en tu tema

En tu GolobaTheme, crear:
```
src/Resources/views/webkul/[nombre-paquete]/
```

**Ejemplo para Marketplace:**
```
src/Resources/views/webkul/marketplace/components/shop/layouts/header/
```

**Nota importante:** Eliminar `/default/` de la ruta si existe en el paquete original.

### 4. Registrar namespace de vistas

En `src/Providers/GolobaThemeServiceProvider.php`, agregar o modificar:

```php
<?php

namespace Webkul\GolobaTheme\Providers;

use Illuminate\Support\ServiceProvider;

class GolobaThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Tu código existente...
        $this->publishes([
            __DIR__.'/../Resources/views'  => resource_path('themes/goloba-theme/views'),
        ]);
        
        // AGREGAR: Cargar vistas de paquetes vendor
        $this->loadVendorViews();
    }

    /**
     * Registrar namespaces para vistas de paquetes vendor
     */
    protected function loadVendorViews()
    {
        // Marketplace
        $this->app['view']->prependNamespace('marketplace', __DIR__ . '/../Resources/views/webkul/marketplace');
        
        // PayPal
        $this->app['view']->prependNamespace('paypal', __DIR__ . '/../Resources/views/webkul/paypal');
        
        // Agregar otros paquetes según necesites
        // $this->app['view']->prependNamespace('sociallogin', __DIR__ . '/../Resources/views/webkul/sociallogin');
    }

    public function register()
    {
        // Tu código existente...
        
        // AGREGAR: Registrar configuración de Vite para tu tema
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/bagisto-vite.php',
            'bagisto-vite.viters'
        );
    }
}
```

### 5. Crear configuración de Vite

Crear el archivo `src/Config/bagisto-vite.php`:

```php
<?php

return [
    'goloba-theme' => [
        'hot_file'                 => 'shop-goloba-theme-vite.hot',
        'build_directory'          => 'themes/shop/goloba-theme/build',
        'package_assets_directory' => 'src/Resources/assets',
    ],
];
```

**Nota:** Los valores deben coincidir con tu `vite.config.js`.

### 6. Copiar vistas del paquete

Copiar las vistas necesarias desde:
```
packages/Webkul/[NombrePaquete]/src/Resources/views/components/shop/default/
```

Hacia:
```
src/Resources/views/webkul/[nombre-paquete]/components/shop/
```

**Ejemplo:**
```bash
# Copiar vista de Marketplace
cp packages/Webkul/Marketplace/src/Resources/views/components/shop/default/layouts/header/style.blade.php src/Resources/views/webkul/marketplace/components/shop/layouts/header/

cp packages/Webkul/Marketplace/src/Resources/views/components/shop/default/layouts/header/sell.blade.php src/Resources/views/webkul/marketplace/components/shop/layouts/header/
```

### 7. Gestionar assets

#### Si la vista contiene directiva @bagistoVite:

**Opción A: Copiar assets del paquete**

1. **Copiar CSS:**
```bash
cp packages/Webkul/[NombrePaquete]/src/Resources/assets/css/shop.css src/Resources/assets/css/[paquete]-styles.css
```

2. **Agregar a vite.config.js:**
```javascript
input: [
    "src/Resources/assets/css/app.css",
    "src/Resources/assets/js/app.js",
    // AGREGAR nuevo asset
    "src/Resources/assets/css/[paquete]-styles.css",
],
```

3. **Modificar la vista:**
```blade
{{-- Cambiar de: --}}
{{-- @bagistoVite(['src/Resources/assets/css/shop.css'], '[paquete-original]') --}}

{{-- A: --}}
@bagistoVite(['src/Resources/assets/css/[paquete]-styles.css'], 'goloba-theme')
```

**Opción B: Compilar assets del paquete original**

1. **Compilar assets del paquete:**
```bash
cd packages/Webkul/[NombrePaquete]
npm install
npm run build
```

2. **Mantener referencia original:**
```blade
@bagistoVite(['src/Resources/assets/css/shop.css'], '[paquete-original]')
```

### 8. Compilar assets de tu tema

```bash
cd packages/Webkul/GolobaTheme
npm run build
```

### 9. Limpiar caché

```bash
# Desde la raíz del proyecto
php artisan config:clear
php artisan view:clear
```

### 10. Personalizar vistas

Ahora puedes personalizar las vistas copiadas:
- Agregar clases CSS de tu tema
- Modificar estructura HTML
- Integrar con tus componentes

## Ejemplo completo: Marketplace

### Estructura creada:
```
GolobaTheme/
├── src/
│   ├── Config/
│   │   └── bagisto-vite.php
│   ├── Resources/
│   │   ├── assets/
│   │   │   └── css/
│   │   │       └── marketplace-styles.css
│   │   └── views/
│   │       └── webkul/
│   │           └── marketplace/
│   │               └── components/
│   │                   └── shop/
│   │                       └── layouts/
│   │                           └── header/
│   │                               ├── style.blade.php
│   │                               └── sell.blade.php
│   └── Providers/
│       └── GolobaThemeServiceProvider.php
```

### Contenido de style.blade.php:
```blade
@bagistoVite(['src/Resources/assets/css/marketplace-styles.css'], 'goloba-theme')
```

### Contenido de sell.blade.php:
```blade
@if (core()->getConfigData('marketplace.settings.general.status'))
    <a
        href="{{ route('marketplace.seller_central.index') }}"
        aria-label="Sell"
        class="goloba-sell-button" {{-- Agregar tus clases --}}
    >
        <span class="goloba-store-icon">{{-- Tu ícono personalizado --}}</span>
        <span class="hidden sm:inline">Vender</span>
    </a>
@endif
```

## Paquetes compatibles

Este proceso funciona para cualquier paquete de Webkul:
- ✅ Marketplace
- ✅ PayPal
- ✅ Social Login
- ✅ Social Share
- ✅ MagicAI
- ✅ Cualquier paquete de terceros

## Troubleshooting

### Error: "Viter with goloba-theme namespace not found"
- Verificar que existe `src/Config/bagisto-vite.php`
- Verificar registro en Service Provider
- Ejecutar `php artisan config:clear`

### Vistas no se cargan
- Verificar estructura de directorios
- Verificar registro de namespace en Service Provider
- Ejecutar `php artisan view:clear`

### Assets no se cargan
- Verificar que están agregados en `vite.config.js`
- Ejecutar `npm run build`
- Verificar rutas en las vistas

## Ventajas de este enfoque

✅ **Escalable**: Fácil agregar más paquetes
✅ **Mantenible**: No modifica archivos originales
✅ **Compatible**: Con actualizaciones de paquetes
✅ **Centralizado**: Todo en tu tema
✅ **Reutilizable**: Mismo patrón para cualquier paquete

## Notas importantes

- **No modificar** archivos originales de los paquetes
- **Siempre eliminar** `/default/` de las rutas al copiar
- **Compilar assets** después de cualquier cambio
- **Limpiar caché** después de cambios en configuración