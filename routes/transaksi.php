<?php

use App\Http\Controllers\Transaksi\Penjualan\PenjualanController;

Route::group(['prefix' => 'penjualan-obat', 'namespace' => 'Transaksi\Penjualan'], function() {

    Route::get('/', [PenjualanController::class, 'index']);
    Route::get('/add', [PenjualanController::class, 'form_add']);
    Route::post('/add-detail', [PenjualanController::class, 'add_detail']);
    
});