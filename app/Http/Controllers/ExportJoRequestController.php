<?php

namespace App\Http\Controllers;

use App\Exports\exportJoRequestReport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

use App\Models\JoRequest;
use App\Models\JoRequestConformance;

class ExportJoRequestController extends Controller
{
    public function exportJoRequestReport(Request $request){

        // return 'asd';
        $deptCount = JoRequest::whereBetween('created_at', [$request->date_from,$request->date_to])
        ->where('status', 3)
        ->get();

        $classificationCount = JoRequestConformance::whereBetween('created_at', [$request->date_from,$request->date_to])
        // ->where('status', 3)
        ->get();

        // return count($deptCount);

        // return $classificationCount;


        return Excel::download(new exportJoRequestReport(
            $deptCount,
            $classificationCount
        ), 
        'JoRequest.xlsx');
    }
}
