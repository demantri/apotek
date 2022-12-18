<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JurnalModel extends Model
{
    use HasFactory;

    public function singleJurnal($id_trx, $tgl_jurnal, $no_coa, $nominal, $posisi)
    {
        $coa = DB::table('coa')
            ->select('no_coa', 'nama_coa', 'jenis_coa', 'saldo_awal')
            ->where('no_coa', $no_coa)
            ->first();

        $data = [
            'id_trx' => $id_trx,
            'tgl_trx' => $tgl_jurnal,
            'no_coa' => $no_coa,
            'nama_coa' => $coa->nama_coa,
            'nominal' => $nominal,
            'posisi_d_c' => $posisi,
        ];

        return DB::table('jurnal_umum')->insert($data);
    }
}
