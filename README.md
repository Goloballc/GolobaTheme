# Goloba Theme para Bagisto 2.2.4
### Por [Silcon Tech]('https://silcon.tech')

# Instrucciones de instalación

## Obtener Tema
### Clonar desde repositorio
1. Ir a la parte superior.
2. Dar clic en el botón **"<> Code"**.
3. Copiar la URL del repositorio.
4. Abrir la terminal dentro del proyecto en VSCode.
5. Navegar el directorio de paquetes con: `cd packages/Webkul`
6. Usar el siguiente comando: `git clone` seguido de la URL copiada en el paso 3.
### Decargar desde repositorio
1. Ir a la parte superior
2. Dar clic en el botón **"<> Code"**
3. Dar clic en **Download ZIP**
4. Abrir el directorio del proyecto e ir a la ruta `Bagisto/packages/Webkul`
4. Abrir el archivo .zip y copiar el contenido o descomprimirlo dentro de la ruta del proyecto `Bagisto/packages/Webkul`

## Instalar Tema

1. Abrir el archivo `composer.json` y agregar la siguiente línea:
 ```
 "Webkul\\GolobaTheme\\": "packages/Webkul/GolobaTheme/src"
 ``` 
Al final de:
```"autoload": {
        "psr-4": {
            "Webkul\\Theme\\": "packages/Webkul/Theme/src",
            "Webkul\\User\\": "packages/Webkul/User/src",
            "Aqui va el registro del tema"
        }
```
2. Abrir la terminal y ejecutar el comando:
```
composer dump-autoload
```
3. Registrar el Service Provider en `config/app.php`:
    1. Colocar lo siguiente al final de la declaración de los service providers de Bagisto.
    ```
    `Webkul\GolobaTheme\Providers\GolobaThemeServiceProvider::class,`
    ```
    ```
    'providers' => ServiceProvider::defaultProviders()->merge([
         /**
          * Webkul package service providers.
          */
          Webkul\Theme\Providers\ThemeServiceProvider::class,
          Webkul\User\Providers\UserServiceProvider::class,
          Aqui se registra
    ])->toArray(),
    ```
4. Abrir el archivo `themes.php` en la ruta `config/themes.php`
    1. En este archivo se registra el tema para ser reconocido por la interfaz de Bagisto, además se configura la ruta de los assets.
    2. Esta es la sección donde se pegará el codigo, debajo de la clave `default` que está dentro de la clave `shop`
    ```
    'shop' => [
        'default' => [
            'name'        => 'Default',
            'assets_path' => 'public/themes/shop/default',
            'views_path'  => 'resources/themes/default/views',

            'vite'        => [
                'hot_file'                 => 'shop-default-vite.hot',
                'build_directory'          => 'themes/shop/default/build',
                'package_assets_directory' => 'src/Resources/assets',
            ],
        ],
    ],
    ```
    ```
        'goloba-theme' => [
            'name'        => 'Goloba Theme',
            'assets_path' => 'public/themes/goloba-theme/default',
            'views_path'  => 'resources/themes/goloba-theme/views',

            'vite'        => [
                'hot_file'                 => 'shop-goloba-theme-vite.hot',
                'build_directory'          => 'themes/shop/goloba-theme/build',
                'package_assets_directory' => 'src/Resources/assets',
            ],
        ],
    ```
5. Publicar vistas
    1. Abrir la terminal en la raiz del proyecto y ejecutar el siguiente comando:
    ```
    php artisan vendor:publish --provider="Webkul\GolobaTheme\Providers\GolobaThemeServiceProvider"
    ```
6. Compilar Assets
    1. Abrir una terminal nueva en la raiz del proyecto y navegar a la siguiente ruta con:
    ```
    cd packages/Webkul/GolobaTheme
    ```
    2. Ejecutar el siguiente comando y esperar a que se descarguen los node_modules:
    ```
    npm install
    ```
    3. Una vez terminado el proceso anterior ejecutar el siguientes comandos de acuerdo a lo que se necesite:
    ### Compilar estilos (Producción)
    ```
    npm run build
    ```
    ### Compilar estilos cada que se modifiquen las vistas o la configuración de Tailwind (Desarrollo)
    ```
    npm run dev
    ```
## Cambiar el tema de Bagisto
1. Abrir el navegador y e ir al panel del administrador y autenticarse ej. `https://bagisto.test/admin/login`
2. Una vez en el panel del administrador ir a la barra lateral izquierda en **Configuración->Canales**
    1. Dentro de la vista de canales dar clic en el icono del lapiz para editar la configuración del canal.
    2. Hacer scroll hacía abajo hasta encontrar la ventana **Diseño** y dentro de esta en **Tema** Usar el selector para elegir **GolobaTheme**
    3. Hacer scroll hacía arriba y dar clic en el botón **Guardar Canal**
    4. Ir a la url base del sitio `https://bagisto.test` o dar clic al segundo botón de izquierda a derecha en la parte superior derecha (icono tienda).
3. Listo, tema instalado.

## Consideraciones durante el desarrollo
1. Conservar dos terminales
    1. La primera en la raiz del proyecto.
    2. La segunda para compilar los assets en la ruta `packages/Webkul/GolobaTheme`
2. Resolver problemas de vistas que no se muestran correctamente, ya sea porque se eliminaron o no se están mostrando
    1. En la raiz del proyecto la ruta `resources/themes` se encuentra el directorio `goloba-theme` eliminarlo.
    2. Volver a publicar las vistas, en la primera terminal que está situada en la raiz del proyecto ejecutar el siguiente comando:
    ```
    php artisan vendor:publish --provider="Webkul\GolobaTheme\Providers\GolobaThemeServiceProvider"
    ```
    3. El directorio se volverá crear con las vistas.
3. Esta documentación aún no abarca las vistas de los paquetes **Marketplace** y **RMA**, solo lo que corresponde al paquete **Shop** de Bagisto.