<?php

use App\Http\Controllers\Transaksi\Penjualan\PenjualanController;

Route::group(['prefix' => 'penjualan-obat', 'namespace' => 'Transaksi\Penjualan'], function() {

    Route::get('/', [PenjualanController::class, 'index']);
    Route::get('/add', [PenjualanController::class, 'form_add']);
    Route::post('/add-detail', [PenjualanController::class, 'add_detail']);
    Route::post('/simpan-bayar', [PenjualanController::class, 'simpan_bayar']);
    Route::post('/pending', [PenjualanController::class, 'proses_pending']);
    Route::post('/batal', [PenjualanController::class, 'proses_batal']);

    Route::get('/list', [PenjualanController::class, 'getList']);
    Route::post('/findBarang', [PenjualanController::class, 'findBarang']);
    Route::get('/getMember', [PenjualanController::class, 'getMember']);
    
});