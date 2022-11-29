<?php

use App\Http\Controllers\Masterdata\Member\IndexController as MemberIndexController;
use App\Http\Controllers\Masterdata\Member\ProsesController;
use App\Http\Controllers\Masterdata\Obat\IndexController;

Route::group(['prefix' => 'obat', 'namespace' => 'Masterdata\Obat'], function() {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/list', [IndexController::class, 'getList']);
    Route::post('/save', [IndexController::class, 'save']);
    
});

Route::group(['prefix' => 'member', 'namespace' => 'Masterdata\Member'], function() {

    Route::get('/', [MemberIndexController::class, 'index']);
    Route::get('/list', [MemberIndexController::class, 'getList']);
    Route::post('/save', [ProsesController::class, 'store']);
    
});