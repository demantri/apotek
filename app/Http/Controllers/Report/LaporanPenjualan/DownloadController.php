<?php

namespace App\Http\Controllers\Report\LaporanPenjualan;

use App\Exports\ExportExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function export(Request $request) 
    {
        $view = 'excel.laporan-penjualan.index';
        $fileName = 'Laporan Penjulan Obat.xlsx';
        $sheetName = 'Laporan Penjualan Obat';

        $params = [
            'data' => $request->dataArray,
            'headers' => [
                'title' => 'Laporan Penjualan Obat',
            ],
            'footer' => [
                'time_export' => date('d/m/Y H:i:s')
            ]
        ];

        return Excel::download(new ExportExcel(
            $view,
            $params,
            $sheetName,
        ), $fileName);
    }
}
