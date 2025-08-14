<?php

use Illuminate\Support\Facades\Route;
use Webkul\GolobaTheme\Http\Controllers\Customer\RegistrationController;
use Webkul\GolobaTheme\Http\Controllers\Shop\Seller\Account\ProfileController;

Route::group(['middleware' => ['web', 'customer']], function () {
    Route::post('customers/account/addresses/store', [
        \Webkul\GolobaTheme\Http\Controllers\Customer\Account\AddressController::class,
        'store'
    ])->name('shop.customers.account.addresses.store');
});

// Customer Registration
Route::group(['middleware' => ['locale', 'theme', 'currency']], function () {

    Route::prefix('cliente')->group(function () {
        /**
         * Registration routes.
         */
        Route::controller(RegistrationController::class)->group(function () {
            Route::prefix('registro')->group(function () {
                Route::get('', 'index')->name('shop.customers.register.index');

                Route::post('', 'store')->name('shop.customers.register.store');
            });
        });
    });
});

Route::group([
    'middleware' => ['locale', 'theme', 'currency', 'marketplace'],
    'prefix'     => 'vendedor/cuenta',
], function () {
 Route::controller(ProfileController::class)->prefix('perfil-custom')->group(function () {
        Route::put('{id}', 'update')->name('goloba-theme.marketplace.seller.account.profile.update');
    });
});

Route::prefix('vendedor')->group(function () {
    Route::controller(Webkul\GolobaTheme\Http\Controllers\Shop\Seller\Account\RegistrationController::class)->prefix('registro-custom')->group(function () {
        Route::post('', 'store')->name('goloba-theme.marketplace.seller.register.store');
    });
});