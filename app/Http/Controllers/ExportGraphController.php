<?php

namespace App\Http\Controllers;

use App\Exports\GraphExcel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportGraphController extends Controller
{
    public function export() 
    {
        return Excel::download(new GraphExcel , 'testing.xlsx');
    }

}
