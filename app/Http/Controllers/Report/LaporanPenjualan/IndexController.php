<?php

namespace App\Http\Controllers\Report\LaporanPenjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('report.laporan_penjualan.index');
    }

    public function getList(Request $request)
    {
        $params = [
            'tgl_awal' => date('Y-m-d', strtotime($request->tgl_awal)),
            'tgl_akhir' => date('Y-m-d', strtotime($request->tgl_akhir))
        ];

        
        $query = "SELECT * FROM penjualan_obat
        WHERE LEFT(created_at, 10) BETWEEN '".$params['tgl_awal']."' AND '".$params['tgl_akhir']."'
        AND STATUS = '1'";
        
        $data = DB::select($query);

        if ($data < 0 || empty($data)) {
            return response()->json([
                'message' => 'Data tidak ditemukan dalam periode tersebut!',
            ], 400);
        }

        return response()->json($data, 200);
    }
}
