<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Auth;
use Mail;

use App\Models\RapidxUser;
use App\Models\UserAccess;
use App\Models\JoRequest;
use App\Models\JoRequestConformance;

class JoRequestConformanceController extends Controller
{
    // public function viewRequestsForConformance(Request $request)
    // {

    //     $rapidx_user_id = $_SESSION['rapidx_user_id'];

    //     // return $rapidx_user_id;

    //     $jo_request_for_conformance_details = JoRequest::
    //     with(['rapidx_user_details',
    //         'jo_requests_conformance'
    //     ])
    //     ->where('logdel', 0)
    //     ->where('status', 2)
    //     ->orderBy('id', 'asc')
    //     ->get();


    //     // return $jo_request_for_conformance_details;

    //     return DataTables::of($jo_request_for_conformance_details)
    //         ->addColumn('action', function ($jo_request_for_conformance_details) use ($rapidx_user_id) {
    //             $result = "";

    //             switch ($jo_request_for_conformance_details->status) {
    //                 case 2: {
    //                         //view requests
    //                         $result .= ' <button type="button" class="btn btn-sm btn-info btn-conform-requests" data-toggle="modal" data-target="#modalConformedRequest" title="View request" requests-id="' . $jo_request_for_conformance_details->id . '"><i class="fa fa-edit"></i></button>';
    //                         $result .= "";
    //                         break;
    //                     }
    //                 case 3: {
    //                         //view requests
    //                         $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-requests" data-toggle="modal" data-target="#modalViewConformedRequest" title="View request" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';

    //                         $result .= ' <button type="button" class="btn btn-sm btn-primary btn-edit-requests" data-toggle="modal" data-target="#modalEditJORequest" title="Edit request" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';

    //                         break;
    //                 }
    //             }

    //             return $result;
    //         })
    //         ->addColumn('status', function ($jo_request_for_conformance_details) {

    //             $status = "";

    //             switch ($jo_request_for_conformance_details->status) {
    //                 case 2:
    //                     {   
    //                         $status .= '<span class="badge badge-pill badge-primary">For Conformance</span>';
    //                         break;
    //                     }
    //                     case 3:
    //                     {   
    //                         // $status .= '<span class="badge badge-pill badge-success">Approved</span>';
    //                         $status .= '<span class="badge badge-pill badge-warning">For Initial Approval</span>';
    //                         break; 
    //                     }
    //                     case 4:
    //                     {   
    //                         $status .= '<span class="badge badge-pill badge-info">For Final Approval</span>';
    //                         break;
    //                     }
    //             }
    //             return $status;
    //         })

    //         ->addColumn('jo_classification', function ($jo_request_for_conformance_details) {

    //             $result = "";
    //             return $result;
    //         })

    //         ->addColumn('fas_assessment', function ($jo_request_for_conformance_details) {

    //             $result = "";
    //             return $result;
    //         })

    //         ->addColumn('est_date', function ($jo_request_for_conformance_details) {

    //             $result = "";
    //             return $result;
    //         })
            
    //         ->addColumn('assessed_by', function ($jo_request_for_conformance_details) {

    //             $result = "";
    //             return $result;
    //         })

    //         // ->addColumn('assessed_by', function ($jo_request_details) {
    //         //     $result = "";
    //         //     $result = $jo_request_details->rapidx_user_details->name;
    //         //     return $result;
    //         // })

    //         ->rawColumns(['action', 'status', 'jo_classification', 'fas_assessment', 'est_date','assessed_by'])
    //         ->make(true);
    // }

    public function conformJoRequest(Request $request){
        date_default_timezone_set('Asia/Manila');
        $data = $request->all();

        // return $data;

        // return $data;
        $ncp = RapidxUser::where('employee_number', '1627')
        ->get();

        $jcp = RapidxUser::where('employee_number', '4771')
        ->get();

        $kte = RapidxUser::where('employee_number', 'G001')
        ->get();
    

        if($request->recommendation == 3){
            if($request->estimated_type == 1 && $request->estimated_cost >= 5000){
                $conformanceDetailsArray = array(
                    'jo_request_id' => $request->jo_request_id,
                    'fas_assessment' => $request->fas_assessment,
                    'job_classification' => $request->conformace_classification,
                    'recommendation' => $request->recommendation,
                    'others_recommendation' => $request->others_recommendation,
                    'estimated_completion_date' => $request->completion_date,
                    'estimated_cost' => $request->estimated_cost,
                    'estimated_type' => $request->estimated_type,
                    'conformance_remarks' => $request->conformance_remarks,
                    'assessed_by' => $request->fas_engr_assigned,
                    'conformance_status' => 1,
                    'initial_approval' =>  $kte[0]->employee_number,
                    'final_approval_1' =>  $jcp[0]->employee_number,
                    'final_approval_2' =>  $ncp[0]->employee_number, // if value is greater then 5000
                    'created_at' => date('Y-m-d H:i:s'),
                    'logdel' => 0,
                );
            }else{
                $conformanceDetailsArray = array(
                    'jo_request_id' => $request->jo_request_id,
                    'fas_assessment' => $request->fas_assessment,
                    'job_classification' => $request->conformace_classification,
                    'recommendation' => $request->recommendation,
                    'others_recommendation' => $request->others_recommendation,
                    'estimated_completion_date' => $request->completion_date,
                    'estimated_cost' => $request->estimated_cost,
                    'estimated_type' => $request->estimated_type,
                    'conformance_remarks' => $request->conformance_remarks,
                    'assessed_by' => $request->fas_engr_assigned,
                    'conformance_status' => 1,
                    'initial_approval' =>  $kte[0]->employee_number,
                    'final_approval_1' =>  $jcp[0]->employee_number,
                    // 'final_approval_2' =>  $ncp[0]->employee_number, // if value is greater then 5000
                    'created_at' => date('Y-m-d H:i:s'),
                    'logdel' => 0,
                );
            }
        }else{
            if($request->estimated_type == 1 && $request->estimated_cost >= 5000){
                $conformanceDetailsArray = array(
                    'jo_request_id' => $request->jo_request_id,
                    'fas_assessment' => $request->fas_assessment,
                    'job_classification' => $request->conformace_classification,
                    'recommendation' => $request->recommendation,
                    // 'others_recommendation' => $request->others_recommendation,
                    'estimated_completion_date' => $request->completion_date,
                    'estimated_cost' => $request->estimated_cost,
                    'estimated_type' => $request->estimated_type,
                    'conformance_remarks' => $request->conformance_remarks,
                    'assessed_by' => $request->fas_engr_assigned,
                    'conformance_status' => 1,
                    'initial_approval' =>  $kte[0]->employee_number,
                    'final_approval_1' =>  $jcp[0]->employee_number,
                    'final_approval_2' =>  $ncp[0]->employee_number, // if value is greater then 5000
                    'created_at' => date('Y-m-d H:i:s'),
                    'logdel' => 0,
                );
            }else{
                $conformanceDetailsArray = array(
                    'jo_request_id' => $request->jo_request_id,
                    'fas_assessment' => $request->fas_assessment,
                    'job_classification' => $request->conformace_classification,
                    'recommendation' => $request->recommendation,
                    // 'others_recommendation' => $request->others_recommendation,
                    'estimated_completion_date' => $request->completion_date,
                    'estimated_cost' => $request->estimated_cost,
                    'estimated_type' => $request->estimated_type,
                    'conformance_remarks' => $request->conformance_remarks,
                    'assessed_by' => $request->fas_engr_assigned,
                    'conformance_status' => 1,
                    'initial_approval' =>  $kte[0]->employee_number,
                    'final_approval_1' =>  $jcp[0]->employee_number,
                    // 'final_approval_2' =>  $ncp[0]->employee_number, // if value is greater then 5000
                    'created_at' => date('Y-m-d H:i:s'),
                    'logdel' => 0,
                );
            }
           
        }

        $conformanceAddEngineer = array(
            'jo_request_id' => $request->jo_request_id,
            'assessed_by' => $request->fas_engr_assigned,
            'initial_approval' =>  $kte[0]->employee_number,
            'final_approval_1' =>  $jcp[0]->employee_number,
            'conformance_status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'logdel' => 0,
        );

    //EMAIL
    // $approver = RapidXUser::with(['department_details'])->where('id', $request->jo_request_approver)->get();
    // $checker = RapidXUser::with(['department_details'])->where('id', $request->jo_request_checker)->get();

    // // return $checker;

    // $requestor = RapidXUser::where('id', $request->requestor_id)->get();

        // $data = [
        //     'requestor' => $requestor[0]->name,
        //     'joNumber' => $request->jo_no, 
        //     'checker' => $checker, 
        //     'equipmentName' => $request->equipment_name, 
        //     'joDescription' => $request->jo_description,
        //     'factoryClassification' => $factory,

        // ];

        // $recipients = $checker[0]->email;

        // Mail::send('mail.send_for_checking', $data, function ($message) use ($recipients) {
        //     $message->to($recipients)
        //         ->subject('Job Order Request Notification')
        //         ->bcc('mrronquez@pricon.ph');
        // });

        DB::commit();

        if(isset($request->conform_request_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conform_request_id)
            ->update($conformanceDetailsArray);
            return response()->json(['result' => "1"]);
        }else{
            // return 'null';
            JoRequestConformance::insert($conformanceAddEngineer);
            return response()->json(['result' => "1"]);
        }   
    }

    public function getConformanceDetails(Request $request){
        // return $request->conformance_id;
        $conformanceDetails = JoRequestConformance::with(['rapidx_user_details'])
        ->where('jo_request_id', $request->conformance_id)
        ->get();

        // return $conformanceDetails;
        return response()->json(['conformanceDetails' => $conformanceDetails]);
    }

    public function conformanceByKTE(Request $request){
        // return 'conformance';
        // return $request->conformance_id;

        $conformanceOfKTE = array(
            'conformance_status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
        );

        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($conformanceOfKTE);
            return response()->json(['result' => "1"]);
        } 
    }

    public function disconformanceByKTE(Request $request){
        $disconformanceByKTE = array(
            'conformance_status' => 5,
            'initial_disapproval_remarks' => $request->reason,
            'initial_disapproval_datetime' => date('Y-m-d H:i:s'),
        );

        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($disconformanceByKTE);
            return response()->json(['result' => "1"]);
        } 
    }

    public function conformanceByJCP(Request $request){
        // return 'conformance';
        // return $request->conformance_id;

        $JOConformanceDetails = JoRequestConformance::where('id', $request->conformance_id)
        ->get();

        if($JOConformanceDetails[0]->estimated_cost >= 5000){
            $conformanceOfJCP = array(
                'conformance_status' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            );
        }else{
            $conformanceOfJCP = array(
                'conformance_status' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            );
        }

        

        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($conformanceOfJCP);
            return response()->json(['result' => "1"]);
        } 
    }

    public function disconformanceByJCP(Request $request){
        $disconformanceByJCP = array(
            'conformance_status' => 6,
            'final_approval_1_disapproval_remarks' => $request->reason,
            'final_disapproval_1_datetime' => date('Y-m-d H:i:s'),
        );

        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($disconformanceByJCP);
            return response()->json(['result' => "1"]);
        } 
    }

    public function conformanceByNCP(Request $request){
        // return 'conformance';
        // return $request->conformance_id;

        $conformanceOfNCP = array(
            'conformance_status' => 4,
            'final_approval_2_datetime' => date('Y-m-d H:i:s'),
        );
        
        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($conformanceOfNCP);
            return response()->json(['result' => "1"]);
        } 
    }

    public function disconformanceByNCP(Request $request){
        $disconformanceByNCP = array(
            'conformance_status' => 7,
            'final_approval_2_disapproval_remarks' => $request->reason,
            'final_disapproval_2_datetime' => date('Y-m-d H:i:s'),
        );

        if(isset($request->conformance_id)){
            // return 'set';
            JoRequestConformance::where('id', $request->conformance_id)
            ->update($disconformanceByNCP);
            return response()->json(['result' => "1"]);
        } 
    }

    

}
