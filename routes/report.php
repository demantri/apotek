<?php

use App\Http\Controllers\Report\LaporanPenjualan\DownloadController;
use App\Http\Controllers\Report\LaporanPenjualan\IndexController;


Route::group(['prefix' => 'laporan-penjualan', 'namespace' => 'Report\LaporanPenjualan'], function() {

    Route::get('/', [IndexController::class, 'index']);
    Route::post('/list', [IndexController::class, 'getList']);
    Route::post('/excel', [DownloadController::class, 'export']);
    
});