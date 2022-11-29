<?php

use App\Http\Controllers\Masterdata\Obat\IndexController;

Route::group(['prefix' => 'obat', 'namespace' => 'Masterdata\Obat'], function() {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/list', [IndexController::class, 'getList']);
    Route::post('/save', [IndexController::class, 'save']);
    
});