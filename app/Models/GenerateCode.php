<?php 

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GenerateCode extends Model
{
    public function createNoRM() {
        $no_rm = DB::table('tbl_pasien')
                        ->selectRaw('RIGHT(id, 5) as kode')
                        ->limit(1);
        $query = $no_rm->get();

        if (count($query) <> 0) {
            $data = $query->first();
            $kode = intval($data->kode) + 1;
        } else {
                $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $date = date('Ymd');
        $kodetampil = "RM".$date.$batas;
        return $kodetampil;
    }

    public function createNoRegistrasi() {
        $no_regist = DB::table('tbl_pendaftaran')
                        ->selectRaw('RIGHT(id, 5) as kode')
                        ->orderBy('id_daftar')
                        ->limit(1);
        $query = $no_regist->get();

        if (count($query) <> 0) {
            $data = $query->first();
            $kode = intval($data->kode) + 1;
        } else {
                # code...
                $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $date = date('Ymd');
        $kodetampil = "OKL".$date.$batas;
        return $kodetampil;
    }

    public function kodeBrg() {
        $kode_brg = DB::table('obat')
                        ->selectRaw('RIGHT(kode, 4) as kode')
                        ->orderBy('id', 'desc')
                        ->limit(1);
        $query = $kode_brg->get();

        if (count($query) <> 0) {
            $data = $query->first();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "BRG".$batas;
        return $kodetampil;
    }

    public function kodeMember() {
        $kode_brg = DB::table('member')
                        ->selectRaw('RIGHT(kode_member, 4) as kode')
                        ->orderBy('id', 'desc')
                        ->limit(1);
        $query = $kode_brg->get();

        if (count($query) <> 0) {
            $data = $query->first();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $date= date('Ymd');
        $kodetampil = "M".$date.$batas;
        return $kodetampil;
    }
}
