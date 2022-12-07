<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->data_array();
        // dd($data);
        
        return view('dashboard.index', $data);
    }

    private function data_array()
    {
        $date = date('Y-m');
        $penjualan = DB::select("select invoice, tgl_transaksi from penjualan_obat where left(tgl_transaksi, 7) = '$date' and status = '1'");
        $pendapatan = DB::select("select sum(grandtotal) as total from penjualan_obat where left(tgl_transaksi, 7) = '$date' and status = '1'");
        $member = DB::select("select kode_member, nama_member from member where status = '1'");
        $pembelian_obat = DB::select("select invoice, tgl_transaksi from pembelian_obat where left(tgl_transaksi, 7) = '$date' and status = '1'");
        
        $data = [
            'penjualan' => count($penjualan),
            'pendapatan' => $pendapatan[0],
            'member' => count($member),
            'pembelian_obat' => count($pembelian_obat),
        ];

        return $data;
        // return response()->json($data, 200);
    }
}
