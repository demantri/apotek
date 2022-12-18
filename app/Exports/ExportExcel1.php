<?php

namespace App\Exports;

use App\Models\DummyModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcel1 implements FromCollection
{
    public function collection()
    {
        return DummyModel::all();
    }

}
