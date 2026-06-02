<?php

use App\Http\Controllers\ConsumidorController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('consumidores', ConsumidorController::class);
    Route::resource('ingresos', IngresoController::class);
    Route::resource('gastos', GastoController::class);
});
