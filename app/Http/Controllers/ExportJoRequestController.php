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
        $deptCount = JoRequest::whereBetween('created_at', [$request->date_from,$request->date_to])
        ->where('status', 3)
        ->get();

        $classificationCount = JoRequestConformance::whereBetween('created_at', [$request->date_from,$request->date_to])
        // ->where('status', 3)
        ->get();

        $joRequestDetails = JoRequest::with([
        'rapidx_user_details',
        'jo_requests_conformance',
        'jo_requests_conformance.rapidx_user_details'])
        // ->where('status', 3)
        ->get();

        $date = now();
        $date = date_format($date, "mdY");

        // return $date;

        // return $joRequestDetails;y

        // return count($deptCount);

        // return $classificationCount;


        return Excel::download(new exportJoRequestReport(
            $deptCount,
            $classificationCount,
            $joRequestDetails
        ), 
        'JO Request Report as of '. $date.'.xlsx');
    }
}
