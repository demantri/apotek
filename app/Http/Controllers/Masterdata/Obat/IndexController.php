<?php 

namespace App\Http\Controllers\Masterdata\Obat;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GenerateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{

    public function __construct() {
        $this->kode = new GenerateCode();
    }

    public function index()
    {
        $kode = $this->kode->kodeBrg();
        return view('masterdata.obat.index', compact('kode'));
    }

    public function getList()
    {
        $data = DB::table("obat")->orderBy('id')->get();
        return response()->json($data, 200);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
    		'kode_obat' => 'required',
            'nama_obat' => 'required',
            // 'jenis_obat' => 'required',
            'satuan' => 'required',
            'stok_obat' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
    	]);

    	if ($validator->fails()) return response()->json($validator->messages(), 422);

        try {
            $data = [
                'kode' => $request->kode_obat,
                'nama' => $request->nama_obat,
                // 'jenis_obat' => $request->jenis_obat,
                'harga_beli' => str_replace('.', '', $request->harga_beli),
                'harga_jual' => str_replace('.', '', $request->harga_jual),
                'stok' => $request->stok_obat,
                'satuan' => $request->satuan,
            ];

            DB::table('obat')->insert($data);

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil disimpan'
            ], 200);
        } catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
        }
    }
}
