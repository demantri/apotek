<?php 

namespace App\Http\Controllers\Transaksi\Penjualan;

use App\Models\GenerateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function __construct() {
        $this->kode = new GenerateCode();
    }

    public function index()
    {
        return view('transaksi.penjualan.index');
    }

    public function form_add()
    {
        $kode = $this->kode->generateCodePnj();
        $obat = DB::table('obat')->orderBy('id', 'asc')->get();

        $detail = DB::table('detail_penjualan_obat')->where('invoice', $kode)->get();
        
        return view('transaksi.penjualan.add', compact('obat', 'kode', 'detail'));
    }

    public function add_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
    		'obat' => 'required',
    		
    	]);

    	if ($validator->fails()) return response()->json($validator->messages(), 422);

        try {
            $invoice = $request->invoice;
            $kode_obat = $request->obat;
            $qty = $request->qty;

            $detail_penjualan = DB::table('detail_penjualan_obat')
                                    ->where('invoice', $invoice)
                                    ->where('kode_obat', $kode_obat)
                                    ->first();
                                    // dd($detail_penjualan->kode_obat);

            $penjualan = DB::table('penjualan_obat')
                                    ->where('status', 2)
                                    ->get();

            $produk = DB::table('obat')->where('kode', $kode_obat)->first();
            // dd($produk);

            if (count($penjualan) == 0) {
                $pnj_obat = [
                    'invoice' => $request->invoice,
                    'tgl_transaksi' => $request->tgl_transaksi,
                    'status' => 2
                ];
    
                DB::table('penjualan_obat')->insert($pnj_obat);
    
                $detail_obat = [
                    'invoice' => $request->invoice,
                    'kode_obat' => $produk->kode,
                    'nama_obat' => $produk->nama,
                    'harga_satuan' => $produk->harga_jual,
                    'qty' => $qty,
                    'subtotal' => $produk->harga_jual * $qty
                ];

                DB::table('detail_penjualan_obat')->insert($detail_obat);

            } else {
                if (empty($detail_penjualan->kode_obat)) {
                    $detail_obat = [
                        'invoice' => $request->invoice,
                        'kode_obat' => $produk->kode,
                        'harga_satuan' => $produk->harga_jual,
                        'qty' => $qty,
                        'subtotal' => $produk->harga_jual * $qty
                    ];
    
                    DB::table('detail_penjualan_obat')->insert($detail_obat);
                } else {
                    $hasil = $detail_penjualan->qty + $qty;
                    
                    $data_arr = [
                        'qty' => $hasil
                    ];
                    
                    DB::table('detail_penjualan_obat')
                        ->where('invoice', $invoice)
                        ->where('kode_obat', $produk->kode)
                        ->update($data_arr);
                }
            }

            return response()->json([
                'message' => 'Data berhasil disimpan'
            ], 200);
        } catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
        }
    }
}
