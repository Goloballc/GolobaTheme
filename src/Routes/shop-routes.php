<?php

use Illuminate\Support\Facades\Route;
use Goloba\GolobaTheme\Http\Controllers\Shop\GolobaThemeController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency'], 'prefix' => 'golobatheme'], function () {
    Route::get('', [GolobaThemeController::class, 'index'])->name('shop.golobatheme.index');
});