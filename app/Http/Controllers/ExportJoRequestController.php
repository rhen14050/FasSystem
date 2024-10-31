<?php

namespace App\Http\Controllers;

use App\Exports\exportJoRequestReport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ExportJoRequestController extends Controller
{
    public function exportJoRequestReport(Request $request){

        // return 'asd';


        return Excel::download(new exportJoRequestReport(
        // $receiving_data
        ), 
        'JoRequest.xlsx');
    }
}
