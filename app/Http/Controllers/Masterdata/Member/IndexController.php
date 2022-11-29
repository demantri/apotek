<?php

namespace App\Http\Controllers\Masterdata\Member;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GenerateCode;

class IndexController extends Controller
{
    public function __construct() {
        $this->kode = new GenerateCode();
    }

    public function index()
    {
        $kode = $this->kode->kodeMember();
        return view('masterdata.member.index', compact('kode'));
    }

    public function getList()
    {
        $data = DB::table("member")->orderBy('id')->get();
        return response()->json($data, 200);
    }
}
