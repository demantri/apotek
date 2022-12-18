<?php 

namespace App\Http\Controllers\Transaksi\Penjualan;

use App\Models\GenerateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JurnalModel;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function __construct() {
        $this->kode = new GenerateCode();
        $this->jurnal = new JurnalModel();
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
                        'nama_obat' => $produk->nama,
                        'harga_satuan' => $produk->harga_jual,
                        'qty' => $qty,
                        'subtotal' => $produk->harga_jual * $qty
                    ];
    
                    DB::table('detail_penjualan_obat')->insert($detail_obat);
                } else {
                    // dd($produk->harga_jual);
                    $harga_satuan = $produk->harga_jual;
                    $hasil = $detail_penjualan->qty + $qty;
                    
                    $data_arr = [
                        'qty' => $hasil,
                        'subtotal' => $hasil * $harga_satuan
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

    public function simpan_bayar(Request $request)
    {
        try {
            $invoice = $request->invoice_add;
            $pelanggan = $request->pelanggan;

            $kode_obat = $request->kode_obat;
            $qty = $request->qty;

            for ($i=0; $i < count($kode_obat); $i++) { 

                $obat = DB::table('obat')->where('kode', $kode_obat[$i])->first();
                $last_stok = ($obat->stok) - ($qty[$i]);

                if ($last_stok < 0) {
                    # code...
                    return response()->json([
                        'message' => 'Stok kurang dari 0! silahkan periksa stok akhir!'
                    ], 402); 
                }

                DB::table('obat')
                    ->where('kode', $kode_obat[$i])
                    ->update([
                        'stok' => $last_stok
                    ]);
            }

            $data = [
                'pelanggan' => $pelanggan,
                'status' => 1,
                'total_transaksi' => str_replace(',', '', $request->total_transaksi_add),
                'ppn' => str_replace(',', '', $request->ppn_add),
                'grandtotal' => str_replace(',', '', $request->grandtotal_add),
                'kembalian' => str_replace(',', '', $request->kembalian_add),
                'nominal_pembayaran' => str_replace(',', '', $request->nominal_pembayaran_add)
            ];

            DB::table('penjualan_obat')
                ->where('invoice', $invoice)
                ->update($data);

            // jurnal debit
            $this->jurnal->singleJurnal(
                $invoice,
                date('Y-m-d'),
                111,
                $request->total_transaksi_add,
                'd'
            );

            // jurnal kredit
            $this->jurnal->singleJurnal(
                $invoice,
                date('Y-m-d'),
                400,
                $request->total_transaksi_add,
                'k'
            );

            return response()->json([
                'message' => 'Data berhasil disimpan'
            ], 200);
        } catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
        }
    }

    public function getList()
    {
        $data = DB::table('penjualan_obat')->where('status', '!=', 2)->orderBy('id', 'desc')->get();
        return response()->json($data, 200); 
    }

    public function findBarang(Request $request)
    {
        $kode_obat = $request->kode_obat;
        
        $data = DB::table('obat')->where('kode', $kode_obat)->first();

        return response()->json($data, 200);
    }

    public function getMember()
    {
        $data = DB::table('member')->where('status', 1)->orderBy('id', 'asc')->get();
        return response()->json($data, 200);
    }

    public function proses_pending(Request $request)
    {
        $invoice = $request->invoice;

        $update = [
            'pelanggan' => '-',
            'status' => 3,
            'total_transaksi' => '-',
            'ppn' => '-',
            'grandtotal' => '-',
            'kembalian' => '-',
            'nominal_pembayaran' => '-',
        ];

        DB::table('penjualan_obat')
            ->where('invoice', $invoice)
            ->update($update);

        return response()->json([
            'message' => 'Transaksi berhasil dipending'
        ], 200);
    }

    public function proses_batal(Request $request)
    {
        $invoice = $request->invoice;

        $update = [
            'pelanggan' => '-',
            'status' => 4,
            'total_transaksi' => '-',
            'ppn' => '-',
            'grandtotal' => '-',
            'kembalian' => '-',
            'nominal_pembayaran' => '-',
        ];

        DB::table('penjualan_obat')
            ->where('invoice', $invoice)
            ->update($update);

        return response()->json([
            'message' => 'Transaksi berhasil dibatalkan'
        ], 200);
    }
}
