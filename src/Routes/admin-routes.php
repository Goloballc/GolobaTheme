<?php

use Illuminate\Support\Facades\Route;
use Goloba\GolobaTheme\Http\Controllers\Admin\GolobaThemeController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin/golobatheme'], function () {
    Route::controller(GolobaThemeController::class)->group(function () {
        Route::get('', 'index')->name('admin.golobatheme.index');
    });
});