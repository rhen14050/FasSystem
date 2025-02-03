<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use DataTables;
use Auth;
use Mail;

use App\Models\RapidxUser;
use App\Models\UserAccess;
use App\Models\JoRequest;
use App\Models\JoRequestConformance;

class JoRequestController extends Controller
{
    public function viewRequestDetails(Request $request)
    {

        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $user_section = $_SESSION['fas_section'];

        // return $fas_section;

        // return $rapidx_user_id;

        // $jo_request_details = JoRequest::with([
        //     'rapidx_user_details',
        //     'jo_requests_conformance',
        //     'jo_requests_conformance.rapidx_user_details'
        //     ])
        // ->where('logdel', 0)
        // ->where('user_id', $rapidx_user_id)
        // ->orWhere('section_head_id', $rapidx_user_id)
        // ->orWhere('checked_by_id', $rapidx_user_id)
        // ->orderBy('id', 'desc')
        // ->get();

      
        // return $jo_request_details;

        if($rapidx_user_id == 97 || $user_section == 'FAS' || $user_section == 'ISS'){
            $jo_request_details = JoRequest::with([
                'rapidx_user_details',
                'jo_requests_conformance',
                'jo_requests_conformance.rapidx_user_details'
            ])
            // ->orderBy('id', 'desc')
            // ->orderBy('jo_ctrl_no', 'desc')
            ->orderBy('status', 'asc')
            ->get();
        }else{
            $jo_request_details = JoRequest::with([
                'rapidx_user_details',
                'jo_requests_conformance',
                'jo_requests_conformance.rapidx_user_details'
            ])
            ->where('logdel', 0)
            ->where(function ($query) use ($rapidx_user_id) {
                $query->where('user_id', $rapidx_user_id)
                      ->orWhere('section_head_id', $rapidx_user_id)
                      ->orWhere('checked_by_id', $rapidx_user_id);
            })
            ->orWhereHas('jo_requests_conformance', function ($query) use ($rapidx_user_id) {
                $query->where('assessed_by', $rapidx_user_id);
            })
            // ->orWhere('user_id', 97) // Add this line
            // ->orderBy('id', 'desc')
            ->orderBy('status', 'asc')
            // ->orderBy('jo_ctrl_no', 'desc')
            ->get();
        }
        

        $jo_request_conformance = JoRequestConformance::all();
        

        return DataTables::of($jo_request_details)
            ->addColumn('action', function ($jo_request_details) use ($rapidx_user_id, $jo_request_conformance) {

                $result = "";

                if($jo_request_details->status == 0){
                    if ($jo_request_details->checked_by_id == $rapidx_user_id) {
                        //view requests
                        $result .= '<center>';
                        $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-jo-details" data-bs-toggle="modal" data-bs-target="#modalNewJORequest" title="View request" requests-status="' . $jo_request_details->status . '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';
                        $result .= ' <button type="button" class="btn btn-sm btn-success btn-checked-requests" data-bs-toggle="modal" data-bs-target="#modalCheckedRequest" title="Conform request" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check-circle"></i></button>';
                        $result .=  '</center>';
                    } else {
                        //view requests
                        $result .= '<center>';
                        $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-jo-details" data-bs-toggle="modal" data-bs-target="#modalNewJORequest" title="View request" requests-status="' . $jo_request_details->status . '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';
                        $result .=  '</center>';
                       
                        // $result .= "";
                    }
                }
                else if($jo_request_details->status == 1){
                     //view requests
                     if ($jo_request_details->section_head_id == $rapidx_user_id) {
                        $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-jo-details" data-bs-toggle="modal" data-bs-target="#modalNewJORequest" title="View request" requests-status="' . $jo_request_details->status . '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';

                        $result .= ' <button type="button" class="btn btn-sm btn-success btn-approve-requests" data-bs-toggle="modal" data-bs-target="#modalApprovedRequest" title="Conform request" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check-circle"></i></button>';
                    }else{           
                        $result .= '<center>';   
                        $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-jo-details" data-bs-toggle="modal" data-bs-target="#modalNewJORequest" title="View request" requests-status="' . $jo_request_details->status . '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';
                        $result .=  '</center>';
                    }
                    $result .= "";
                }
                else if($jo_request_details->status == 2){
                    // $result .= "";
                    if($jo_request_details->jo_requests_conformance != ''){
                        if($jo_request_details->jo_requests_conformance->conformance_status == 0){     
                            if ($jo_request_details->jo_requests_conformance->assessed_by == $rapidx_user_id) { // ENGINEERING UPDATE
                                $result .= ' <button type="button" class="btn btn-sm btn-info btn-conform-requests" title="Engineering Update" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                            }else{
                            }                       
                        }
                        if($jo_request_details->jo_requests_conformance->conformance_status == 1){
                            if($rapidx_user_id == 97){ // KTE
                                $result .= '<center>';
                                $result .= ' <button type="button" class="btn btn-sm btn-primary btn-conform-requests" title="Conform request by KTE" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                                $result .=  '</center>';
                            }else{
                                if ($jo_request_details->jo_requests_conformance->assessed_by == $rapidx_user_id || $rapidx_user_id == 97) { // ENGINEERING UPDATE
                                    $result .= '<center>';
                                    $result .= ' <button type="button" class="btn btn-sm btn-info btn-conform-requests" title="Engineering Update" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                                    $result .=  '</center>';
                                }
                            }
                        }
                        if($jo_request_details->jo_requests_conformance->conformance_status == 2){
                            if($rapidx_user_id == 147){ // JCP Conformance
                                $result .= ' <button type="button" class="btn btn-sm btn-secondary btn-conform-requests" title="Conform request by JCP" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                            }
                        }
                        if($jo_request_details->jo_requests_conformance->conformance_status == 3){
                            if ($rapidx_user_id== 1627) { // for NCP 
                                $result .= ' <button type="button" class="btn btn-sm btn-primary btn-conform-requests" title="Conform request by NCP" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                            }
                        }
                        if($jo_request_details->jo_requests_conformance->conformance_status == 4){
                            if ($jo_request_details->jo_requests_conformance->assessed_by == $rapidx_user_id) { //CLOSING OF JO
                                $result .= ' <button type="button" class="btn btn-sm btn-success btn-complete-requests" data-toggle="modal" data-target="#modalCompleteRequest" title="Complete request" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check"></i></button>';
                            }
                        } 
                        if($jo_request_details->jo_requests_conformance->conformance_status == 5 || $jo_request_details->jo_requests_conformance->conformance_status == 6 || $jo_request_details->jo_requests_conformance->conformance_status == 7){     
                            if ($jo_request_details->jo_requests_conformance->assessed_by == $rapidx_user_id) { // ENGINEERING UPDATE
                                $result .= '<center>';
                                $result .= ' <button type="button" class="btn btn-sm btn-primary btn-conform-requests" title="Engineering Update" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" conformance-status="' . $jo_request_conformance[0]->conformance_status. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                                $result .= '</center>';
                            }                       
                        }
                    
                    }else{
                        if($rapidx_user_id == 97){ // ASSIGNING OF ENGINEERS BUTTON
                            $result .= '<center>';
                            $result .= ' <button type="button" class="btn btn-sm btn-info btn-conform-requests" title="Assign Engineer" requests-id="' . $jo_request_details->id . '"><i class="fa fa-edit"></i></button>';
                            $result .= '</center>';
                        }
                        $result .= '<center>';
                        $result .= ' <button type="button" class="btn btn-sm btn-info btn-view-jo-details" data-bs-toggle="modal" data-bs-target="#modalNewJORequest" title="View request" requests-status="' . $jo_request_details->status . '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';
                        $result .= '</center>';
                    }
                }
                else if($jo_request_details->status == 3){
                    // commented 10/30/24 *due to removal of checking for completion as per KTE

                    // if($jo_request_details->jo_requests_conformance->conformance_status == 8){
                    //     // if ($jo_request_details->jo_requests_conformance->assessed_by == $rapidx_user_id) { //CHECK OF JO
                    //         $result .= '<center>';
                    //         $result .= ' <button type="button" class="btn btn-sm btn-success btn-checkedtoComplete-requests" data-toggle="modal" data-target="#modalCheckRequest" title="Check request" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check"></i></button>';
                    //         $result .= '</center>';
                    //     // }
                    // } 

                    if($jo_request_details->jo_requests_conformance->conformance_status == 8){
                        if($rapidx_user_id == 97){ // KTE //APPROVE OF JO
                            $result .= '<center>';
                            $result .= ' <button type="button" class="btn btn-sm btn-success btn-apprvToComplete-requests" data-toggle="modal" data-target="#modalApprToCompleteRequest" title="Approve to complete request" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check"></i></button>';
                            $result .= '</center>';
                        }
                    } 

                    if($jo_request_details->jo_requests_conformance->conformance_status == 9){
                        if ($jo_request_details->user_id == $rapidx_user_id) { // JO CONFORMANCE FOR COMPLETION
                            $result .= '<center>';
                            $result .= ' <button type="button" class="btn btn-sm btn-success btn-conformToComplete-requests" data-toggle="modal" data-target="#modalApprToCompleteRequest" title="Conform to complete request" conformance-id="' . $jo_request_conformance[0]->jo_request_id. '" requests-id="' . $jo_request_details->id . '"><i class="fa fa-check"></i></button>';
                            $result .= '</center>';
                        }
                    } 

                    if($jo_request_details->jo_requests_conformance->conformance_status == 10){
                        $result .= '<center>';
                            $result .= ' <button type="button" class="btn btn-sm btn-primary btn-downloadPdf-requests" data-bs-toggle="modal" data-bs-target="#modalDownloadJoDetailsPdf" title="Download JO Request Details" requests-id="' . $jo_request_details->id . '"><i class="fa fa-download"></i></button>';
                            $result .= ' <button type="button" class="btn btn-sm btn-success btn-viewComplete-requests" data-bs-toggle="modal" data-bs-target="#modalViewCompleteRequest" title="View Complete Request" requests-id="' . $jo_request_details->id . '"><i class="fa fa-eye"></i></button>';
                        $result .= '</center>';
                    } 
                }

                return $result;
            })
            ->addColumn('status', function ($jo_request_details) {

                $status = "";

                switch ($jo_request_details->status) {
                    case 0:
                        {   
                            $status .= '<span class="badge badge-pill badge-primary">For Review</span>';
                            break;
                        }
                        case 1:
                        {   
                            $status .= '<span class="badge badge-pill badge-warning">For Section Head Approval</span>';
                            break; 
                        }
                        case 2:
                        {   
                            if($jo_request_details->jo_requests_conformance != ''){
                                if($jo_request_details->jo_requests_conformance->conformance_status == 0){
                                    $status = '<span class="badge badge-pill badge-info">For Update of Assigned Engineer</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 1){
                                    $status = '<span class="badge badge-pill badge-primary">For Conformance of KTE</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 2){
                                    $status = '<span class="badge badge-pill badge-secondary">For Conformance of JCP</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 3){
                                    $status = '<span class="badge badge-pill badge-primary">For Conformance of NCP</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 4){
                                    $status = '<span class="badge badge-pill badge-primary">JO Ongoing</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 5){
                                    $status = '<span class="badge badge-pill badge-danger">Request DISCONFIRM by KTE!</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 6){
                                    $status = '<span class="badge badge-pill badge-danger">Request DISCONFIRM by JCP!</span>';
                                }
                                if($jo_request_details->jo_requests_conformance->conformance_status == 7){
                                    $status = '<span class="badge badge-pill badge-danger">Request DISCONFIRM by NCP!</span>';
                                }
                            }else{
                                $status = '<span class="badge badge-pill badge-info">For Conformance</span>';
                            }
                            break;
                        }
                        case 3:
                            {
                                $status = '<span class="badge badge-pill badge-success">JO REQUEST DONE</span>';
                                break;
                            }
                }
                return $status;
            })

            ->addColumn('attachment', function ($jo_request_details) {
                $result = "";
                if ($jo_request_details->orig_name == null) {
                    $result = '<label>N/A</label>';
                } else {
                    $result .= "<a href='download_attachment/$jo_request_details->id'>$jo_request_details->orig_name</a>";

                }
                return $result;
            })

            ->addColumn('prepared_by', function ($jo_request_details) {
                $result = "";
                $result = $jo_request_details->rapidx_user_details->name;
                return $result;
            })

            ->addColumn('jo_classification', function ($jo_request_details) {
                $result = "";
                if($jo_request_details->jo_requests_conformance != ''){
                    // $result = $jo_request_details->jo_requests_conformance->job_classification
                    if($jo_request_details->jo_requests_conformance->job_classification == 1){
                        $result = 'Machine Repair and Troubleshooting';
                    }else if($jo_request_details->jo_requests_conformance->job_classification == 2){
                        $result = 'Machine/Equipment Modification';
                    }else if($jo_request_details->jo_requests_conformance->job_classification == 3){
                        $result = 'Machine/Equipment Development';
                    }else if($jo_request_details->jo_requests_conformance->job_classification == 4){
                        $result = 'Program/Software Development';
                    }
                }else{
                    $result = "---";
                }
                return $result;
            })

            ->addColumn('fas_assessment', function ($jo_request_details) {
                $result = "";
                if($jo_request_details->jo_requests_conformance != ''){
                    $result = $jo_request_details->jo_requests_conformance->fas_assessment;
                }else{
                    $result = "---";
                }
                return $result;
            })

            ->addColumn('fas_attachment', function ($jo_request_details) {
                $result = "";

                if(empty($jo_request_details->jo_requests_conformance->conformance_attachment)){
                    $result = "<label>N/A</label>";
                }else{
                    $id = $jo_request_details->jo_requests_conformance->id; 
                    $result .= "<a href='download_fas_attachment/$id'>";
                    $result .=  $jo_request_details->jo_requests_conformance->attachment_orig_name;
                    $result .="</a>";     
                }

                return $result;
            })

            ->addColumn('est_date', function ($jo_request_details) {
                $result = "";
                if($jo_request_details->jo_requests_conformance != ''){
                    $result = $jo_request_details->jo_requests_conformance->estimated_completion_date;
                }else{
                    $result = "---";
                }
                return $result;
            })

            ->addColumn('assessed_by', function ($jo_request_details) {
                $result = "";
                if($jo_request_details->jo_requests_conformance != ''){
                    $result = $jo_request_details->jo_requests_conformance->rapidx_user_details->name;
                }else{
                    $result = "---";
                }
                return $result;
            })

            ->addColumn('conformance_status', function ($jo_request_details) {
                $result = "";
                if($jo_request_details->jo_requests_conformance != ''){
                    // $result = $jo_request_details->jo_requests_conformance->conformance_status;
                    if($jo_request_details->jo_requests_conformance->conformance_status == 0){
                        $result = '<span class="badge badge-pill badge-info">For Update of Assigned Engineer</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 1){
                        $result = '<span class="badge badge-pill badge-primary">For Conformance of KTE</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 2){
                        $result = '<span class="badge badge-pill badge-secondary">For Conformance of JCP</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 3){
                        $result = '<span class="badge badge-pill badge-primary">For Conformance of NCP</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 4){
                        $result = '<span class="badge badge-pill badge-primary">JO Ongoing</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 5){
                        $result = '<span class="badge badge-pill badge-danger">For Update of Assigned Engineer</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 6){
                        $result = '<span class="badge badge-pill badge-danger">For Update of Assigned Engineer</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 7){
                        $result = '<span class="badge badge-pill badge-danger">For Update of Assigned Engineer</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 8){
                        $result = '<span class="badge badge-pill badge-primary">For checking to complete</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 9){
                        $result = '<span class="badge badge-pill badge-primary">For approval to complete</span>';
                    }
                    if($jo_request_details->jo_requests_conformance->conformance_status == 10){
                        $result = '<span class="badge badge-pill badge-success">JO REQUEST DONE</span>';
                    }
                    // if($jo_request_details->jo_requests_conformance->conformance_status == 10){
                    //     $result = '<span class="badge badge-pill badge-success">JO Request DONE</span>';
                    // }
                }
                else{
                    if($jo_request_details->status == 2){
                        $result = '<span class="badge badge-pill badge-info">For Assigning of FAS Engineer</span>';
                    }else{
                        $result = '---';
                    }
                }
                return $result;
            })

            ->rawColumns(['action', 'status', 'attachment', 'prepared_by', 'jo_classification', 'fas_assessment', 'est_date', 'assessed_by','conformance_status', 'fas_attachment'])
            ->make(true);
    }

    public function getJORecords(Request $request){
        // session_start();

        $requestor_id = $_SESSION['rapidx_user_id'];

        $user = RapidXUser::with([
        'department_details', 
        // 'hris_details'
        ])
        ->where('id', $requestor_id)
        ->get();

        $dept = $user[0]['department_details']['department_group'];

        // return $user;

        $jo_request_control_number = '';
        $currentMonth = date('m');
        $year = date('y');
        $currentYear = date('Y');
        $fiscalYearStartMonth = 4; 
        $counter = 0;

        $jo_request_details = JoRequest::where('logdel',0)->whereYear('created_at', $currentYear)->orderBy('id','desc')->first();

        // return $jo_request_details;

        if($jo_request_details != null && $currentMonth < $fiscalYearStartMonth)
        {   
            $control_number = $jo_request_details->jo_ctrl_no;
            $number = explode('-',$control_number);
            $counter = intval($number[3]) + 1; 
            
        }
        else
        {
            $counter = 1;
        }

        // return $counter;

        $jo_request_control_number = "FASJO"."-".$dept. "-". $currentMonth . $year  . "-" . str_pad($counter, 3, "0", STR_PAD_LEFT);       

        return response()->json(['result' => 1, 'jo_request_control_number' => $jo_request_control_number , 'user' => $user]);        
    }

    public function downloadAttachment(Request $request){
        $attachment = JORequest::where('id', $request->request_id)->where('logdel', 0)->get();

        // return $attachment;

        $file =  storage_path() . "/app/public/file_attachments/" . $attachment[0]->file_attachment;

        // return $file;

        return Response::download($file, $attachment[0]->orig_name);
    }


    public function addJORequest(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        
        // return $data;

        // return $request->request_id;

        if ($request->hasFile('add_attachment')){
            // return 'if';
            DB::beginTransaction();
                //attachment filename
                $generated_filename = "JO_Request_attachment_" . date('YmdHis');
                $original_filename = $request->file('add_attachment')->getClientOriginalName();
                $file_extension = $request->file('add_attachment')->getClientOriginalExtension();
                $jo_request_attachment_filename = $generated_filename . "." . $file_extension;
    
                    Storage::putFileAs('public/file_attachments/', $request->add_attachment, $jo_request_attachment_filename);
                    $jo_array = array(
                        'jo_ctrl_no' => $request->jo_no,
                        'department' => $request->department,
                        'date_filed' => $request->date_prepared,
                        'equipment_name' => $request->equipment_name,
                        'equipment_no' => $request->equipment_number,
                        'job_description' => $request->jo_description,
                        'initial_action' => $request->initial_action,
                        'currency' => $request->budget_type,
                        'allocated_budget' => $request->allocated_budget,
                        'factory_classification' => $request->factory_classification,
                        'file_attachment' => $jo_request_attachment_filename,
                        'orig_name' => $original_filename,
                        'status' => 0,
                        'user_id' => $request->requestor_id,
                        'checked_by_id' => $request->jo_request_checker,
                        'section_head_id' => $request->jo_request_approver,
                        'created_by' => $request->requestor_id,
                        // 'last_updated_by' => $request->requestor_id,
                        // 'updated_at' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'logdel' => 0,
                    );

                    $jo_array_update = array(
                        'jo_ctrl_no' => $request->jo_no,
                        'department' => $request->department,
                        'date_filed' => $request->date_prepared,
                        'equipment_name' => $request->equipment_name,
                        'equipment_no' => $request->equipment_number,
                        'job_description' => $request->jo_description,
                        'initial_action' => $request->initial_action,
                        'currency' => $request->budget_type,
                        'allocated_budget' => $request->allocated_budget,
                        'factory_classification' => $request->factory_classification,
                        'file_attachment' => $jo_request_attachment_filename,
                        'orig_name' => $original_filename,
                        'status' => 0,
                        'user_id' => $request->requestor_id,
                        'checked_by_id' => $request->jo_request_checker,
                        'section_head_id' => $request->jo_request_approver,
                        'created_by' => $request->requestor_id,
                        'last_updated_by' => $request->requestor_id,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'logdel' => 0,
                    );

                //EMAIL
                $approver = RapidXUser::with(['department_details'])->where('id', $request->jo_request_approver)->get();
                $checker = RapidXUser::with(['department_details'])->where('id', $request->jo_request_checker)->get();

                // return $checker;

                $requestor = RapidXUser::where('id', $request->requestor_id)->get();

                    if($request->factory_classification == 1){
                        $factory = 'Factory 1';
                    }else{
                        $factory = 'Factory 3';
                    }

                    $data = [
                        'requestor' => $requestor[0]->name,
                        'joNumber' => $request->jo_no, 
                        'checker' => $checker, 
                        'equipmentName' => $request->equipment_name, 
                        'joDescription' => $request->jo_description,
                        'factoryClassification' => $factory,

                    ];

                    $recipients = $checker[0]->email;

                    Mail::send('mail.send_for_checking', $data, function ($message) use ($recipients) {
                        $message->to($recipients)
                            ->subject('Job Order Request Notification')
                            ->bcc('mrronquez@pricon.ph');
                    });

                    DB::commit();

                    if(isset($request->request_id)){
                        JoRequest::where('id', $request->request_id)
                        ->update($jo_array_update);
                        return response()->json(['result' => "1"]);
                    }else{
                        JoRequest::insert($jo_array);
                        return response()->json(['result' => "1"]);
                    }   

        }else{
            // return 'else';
            DB::beginTransaction();
            $jo_array = array(
                'jo_ctrl_no' => $request->jo_no,
                'department' => $request->department,
                'date_filed' => $request->date_prepared,
                'equipment_name' => $request->equipment_name,
                'equipment_no' => $request->equipment_number,
                'job_description' => $request->jo_description,
                'initial_action' => $request->initial_action,
                'currency' => $request->budget_type,
                'allocated_budget' => $request->allocated_budget,
                'factory_classification' => $request->factory_classification,
                // 'file_attachment' => $jo_request_attachment_filename,
                // 'orig_name' => $original_filename,
                'status' => 0,
                'user_id' => $request->requestor_id,
                'checked_by_id' => $request->jo_request_checker,
                'section_head_id' => $request->jo_request_approver,
                'created_by' => $request->requestor_id,
                // 'last_updated_by' => $request->requestor_id,
                // 'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'logdel' => 0,
            );

            $jo_array_update = array(
                'jo_ctrl_no' => $request->jo_no,
                'department' => $request->department,
                'date_filed' => $request->date_prepared,
                'equipment_name' => $request->equipment_name,
                'equipment_no' => $request->equipment_number,
                'job_description' => $request->jo_description,
                'initial_action' => $request->initial_action,
                'currency' => $request->budget_type,
                'allocated_budget' => $request->allocated_budget,
                'factory_classification' => $request->factory_classification,
                // 'file_attachment' => $jo_request_attachment_filename,
                // 'orig_name' => $original_filename,
                'status' => 0,
                'user_id' => $request->requestor_id,
                'checked_by_id' => $request->jo_request_checker,
                'section_head_id' => $request->jo_request_approver,
                'created_by' => $request->requestor_id,
                'last_updated_by' => $request->requestor_id,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'logdel' => 0,
            );
                DB::commit();

                ///EMAIL
                $approver = RapidXUser::with(['department_details'])->where('id', $request->jo_request_approver)->get();
                $checker = RapidXUser::with(['department_details'])->where('id', $request->jo_request_checker)->get();

                // return $checker;

                $requestor = RapidXUser::where('id', $request->requestor_id)->get();

                    if($request->factory_classification == 1){
                        $factory = 'Factory 1';
                    }else{
                        $factory = 'Factory 3';
                    }

                    $data = [
                        'requestor' => $requestor[0]->name,
                        'joNumber' => $request->jo_no, 
                        'checker' => $checker, 
                        'equipmentName' => $request->equipment_name, 
                        'joDescription' => $request->jo_description,
                        'factoryClassification' => $factory,

                    ];

                    $recipients = $checker[0]->email;

                    Mail::send('mail.send_for_checking', $data, function ($message) use ($recipients) {
                        $message->to($recipients)
                            ->subject('Job Order Request Notification')
                            ->bcc('mrronquez@pricon.ph');
                    });

                // return response()->json(['result' => "1"]);
                if(isset($request->request_id)){
                    JoRequest::where('id', $request->request_id)
                    ->update($jo_array_update);
                    return response()->json(['result' => "1"]);
                }else{
                    // return 'dito';
                    JoRequest::insert($jo_array);
                    return response()->json(['result' => "1"]);
                }    
        
        }
    }

    public function getJoRequestDetails(Request $request){
        $jo_details = JoRequest::with([
            'rapidx_user_details',
            'rapidx_section_head_details',
            'user_access_details.rapidx_user_details'
        ])
        ->where('id', $request->jo_id)
        ->where('logdel', 0)
        ->get();
        
        // return $jo_details;

        return response()->json(['JODetails' => $jo_details]);
    }

    public function checkedJORequest(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        // return $data;

        // $approved_date = new DateTime(date('Y-m-d'));

            DB::beginTransaction();
            // try {
                if ($request->check_approval_status == 1) {
                    JORequest::where('id', $request->check_request_id)
                        ->update([
                            'status' => 1,
                            'last_updated_by' => $request->approve_requestor_id,
                            'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }else{
                    JORequest::where('id', $request->check_request_id)
                    ->update([
                        'status' => 7,
                        'last_updated_by' => $request->approve_requestor_id,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } 
                DB::commit();


                $forApproval = JORequest::with(['rapidx_user_details','rapidx_section_head_details'])
                ->where('id', $request->check_request_id)
                // ->where('status', 1)
                ->get();

                if($forApproval[0]->factory_classification == 1){
                    $factory = 'Factory 1';
                }else{
                    $factory = 'Factory 3';
                }
                
                // return $forApproval;

                $approver = $forApproval[0]->rapidx_section_head_details->name;
                $requestor = $forApproval[0]->rapidx_user_details->name;

                // return $requestor;

                $approvalCount = count($forApproval);

                $data = ['forApproval' => $forApproval, 'approver' => $approver, 'requestor', $requestor, 'factoryClassification', $factory];

                // return $forconformance;

                if ($approvalCount != 0) {
                    $recipients = $forApproval[0]->rapidx_section_head_details->email;

                    Mail::send('mail.send_for_approval', $data, function ($message) use ($recipients) {
                        $message->to($recipients)
                            ->subject('Job Order Request Notification')
                            ->bcc('cdcasuyon@pricon.ph')
                            ->bcc('mrronquez@pricon.ph');
                    });

                }

                return response()->json(['result' => "1"]);
    }

    public function approvedJORequest(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        // return $data;

        // $approved_date = new DateTime(date('Y-m-d'));

            DB::beginTransaction();
            // try {
                if ($request->approve_approval_status == 3) {
                    JORequest::where('id', $request->approve_request_id)
                        ->update([
                            'status' => 2,
                            'last_updated_by' => $request->approve_requestor_id,
                            'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }else{
                    JORequest::where('id', $request->approve_request_id)
                    ->update([
                        'status' => 8,
                        'last_updated_by' => $request->approve_requestor_id,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } 
                DB::commit();


                $forApproval = JORequest::with(['rapidx_user_details','rapidx_section_head_details'])
                ->where('id', $request->approve_request_id)
                // ->where('status', 1)
                ->get();

                if($forApproval[0]->factory_classification == 1){
                    $factory = 'Factory 1';
                }else{
                    $factory = 'Factory 3';
                }
                
                // return $forApproval;

                $approver = $forApproval[0]->rapidx_section_head_details->name;
                $requestor = $forApproval[0]->rapidx_user_details->name;

                $fas_manager = UserAccess::with(['rapidx_user_details'])
                ->where('rapidx_id', 97)
                ->get();

                // return $fas_manager;

                $fasManager = $fas_manager[0]->rapidx_user_details->name;


                $approvalCount = count($forApproval);

                $data = [
                    'forApproval' => $forApproval, 
                    'approver' => $approver, 'requestor', $requestor, 
                    'factoryClassification', $factory, 
                    'fasManager' => $fasManager
                ];

                // return $forconformance;

                if ($approvalCount != 0) {
                    $recipients = $fas_manager[0]->rapidx_user_details->email;
                    
                    // return $recipients;

                    Mail::send('mail.jo_approved', $data, function ($message) use ($recipients) {
                        $message->to($recipients)
                            ->subject('Job Order Request Notification')
                            ->bcc('cdcasuyon@pricon.ph')
                            ->bcc('mrronquez@pricon.ph');
                    });

                }

                return response()->json(['result' => "1"]);
    }

    public function completeJoRequest(Request $request){
        $data = $request->all();
        // return $data;
        JORequest::where('id', $request->request_id)
            ->update([
                'status' => 3,
                'last_updated_by' => $request->approve_requestor_id,
                'updated_at' => date('Y-m-d H:i:s'),
        ]);   

        JoRequestConformance::where('jo_request_id', $request->request_id)
        ->update([
            'conformance_status' => 8,
            'last_updated_by' => $request->approve_requestor_id,
            'completion_datetime' => date('Y-m-d H:i:s'),
        ]);    

        return response()->json(['result' => "1"]);                                                                                                                                                                                                                                                          
    }
    
    // commented 10/30/24 *due to removal of checking for completion as per KTE

    // public function checkedJoRequestForCompletion(Request $request){
    //     $data = $request->all();
    //     // return $data;
    //     JoRequestConformance::where('jo_request_id', $request->request_id)
    //     ->update([
    //         'conformance_status' => 9,
    //         'completion_check_datetime' => date('Y-m-d H:i:s'),
    //     ]);    

    //     return response()->json(['result' => "1"]);                                                                                                                                                                                                                                                          
    // }

    public function approvedJoToComplete(Request $request){
        $data = $request->all();
        // return $data;
        JoRequestConformance::where('jo_request_id', $request->request_id)
        ->update([
            'conformance_status' => 9,
            'completion_approve_datetime' => date('Y-m-d H:i:s'),
        ]);    

        return response()->json(['result' => "1"]);                                                                                                                                                                                                                                                          
    }

    public function conformanceToCompleteRequest(Request $request){
        $data = $request->all();

        $conformanceToComplete = array(
            'conformance_status' => 10,
            'requestor_conformance_remarks' => $request->remarks,
            'requestor_conformance_datettime' => date('Y-m-d H:i:s'),
        );

        if(isset($request->request_id)){
            // return 'set';
            JoRequestConformance::where('jo_request_id', $request->request_id)
            ->update($conformanceToComplete);
            return response()->json(['result' => "1"]);
        } 
    }

    public function getOngoingJoRequest(){
        $ongoingJoRequest = JORequest::where('logdel', 0 )
        ->where('status', '!=', 3)
        ->get();

        $ongoingJoRequest = count($ongoingJoRequest);
        return response()->json(['ongoingJoRequest' => $ongoingJoRequest]);
    }

    public function getCompletedJoRequest(){
        $completedJoRequest = JORequest::where('logdel', 0 )
        ->where('status', 3)
        ->get();

        $completedJoRequest = count($completedJoRequest);
        return response()->json(['completedJoRequest' => $completedJoRequest]);
    }

    public function getCompletedJoRequestDetails(Request $request){
        $completedJoRequestDetails = JORequest::
        with([   
        'rapidx_user_details',
        'rapidx_section_head_details',
        'user_access_details.rapidx_user_details',
        'jo_requests_conformance',
        'jo_requests_conformance.rapidx_user_details'
        ])
        ->where('id', $request->jo_id )
        ->where('logdel', 0 )
        ->where('status', 3)
        ->get();

        // return $completedJoRequestDetails;

        return response()->json(['completedJoRequestDetails' => $completedJoRequestDetails]);
    }

    // PDF
    public function downloadJoRequestDetailsPDF(Request $request){
        // return $request->requestID;
        
        $joDetails =  JORequest::
        with([   
            'rapidx_user_details',
            'rapidx_section_head_details',
            'user_access_details.rapidx_user_details',
        'jo_requests_conformance',
        'jo_requests_conformance.rapidx_user_details'
        ])
        ->where('id', $request->requestID )
        ->where('logdel', 0)
        ->get();
        
        // return $joDetails;

        $pdf = Pdf::loadView('jo_request_details_pdf', ['joDetails' => $joDetails]);
        
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('JORequestDetails'.'.pdf');
    }

    public function downloadFasAttachment(Request $request){
        $attachment = JORequestConformance::where('id', $request->request_id)->where('logdel', 0)->get();

        // return $attachment;

        $file =  storage_path() . "/app/public/file_attachments/" . $attachment[0]->conformance_attachment;

        // return $file;

        return Response::download($file, $attachment[0]->attachment_orig_name);
    }
}
