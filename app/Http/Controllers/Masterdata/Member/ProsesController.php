<?php

namespace App\Http\Controllers\Masterdata\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProsesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
    		'kode_member' => 'required',
            'nama_member' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required|unique:member,no_telp',
    	]);

    	if ($validator->fails()) return response()->json($validator->messages(), 422);

        try {
            $data = [
                'kode_member' => $request->kode_member,
                'nama_member' => $request->nama_member,
                'alamat_lengkap' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
            ];

            DB::table('member')->insert($data);

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil disimpan'
            ], 200);
        } catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
        }
    }
}
