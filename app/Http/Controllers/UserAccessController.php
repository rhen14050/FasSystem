<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;

use App\Models\RapidxUser;
use App\Models\UserAccess;

class UserAccessController extends Controller
{

    public function loadRapidXUserList(Request $request){
        $users = RapidxUser::where('user_stat', 1)->orderBy('name','asc')->whereNotIn('name',['Admin','Test QAD Admin Approver'])->get();

        return response()->json(['users' => $users]);
    }

    public function loadAccessLevel(Request $request){
        $users = UserAccess::with(['rapidx_user_details'])->where('logdel',0)->get();

        return DataTables::of($users)
        ->addColumn('action',function($user){
            $result = '';

            // $result = "---";
            $result .= '<center>';
            $result .= ' <button type="button" class="btn btn-sm btn-info btn-edit-user" data-bs-toggle="modal" data-bs-target="#modalAddUser" title="Edit User" user-id="' . $user->id . '"><i class="fa fa-edit"></i></button>';
            $result .= ' <button type="button" class="btn btn-sm btn-danger btn-deactivate-user" title="Deactivate User" user-id="' . $user->id . '"><i class="fa fa-remove"></i></button>';
            $result .= '</center>';

            return $result;

        })
        ->addColumn('username',function($user){
            
            $result = $user->rapidx_user_details->username;

            return $result;

        })
        ->addColumn('fullname',function($user){
            
            $result = $user->rapidx_user_details->name;

            return $result;

        })
        ->addColumn('section',function($user){
            
            $result = $user->section;

            return $result;

        })        
        ->addColumn('access_level',function($user){
            
            switch($user->access_level)
            {
                case 1:
                {
                    $result = 'Regular User';
                    break;
                }
                case 2:
                {   
                    $result = 'Section Head';
                    break;
                }
                case 3:
                {
                    $result = 'Administrator';
                    break;
                }
                default:
                {   
                    $result = 'Error!';
                    break;
                }
            }

            return $result;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function addUserAccess(Request $request){
        // session_start();

        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        // return $data;
        DB::beginTransaction();

            // Validate the incoming request data
        $request->validate([
            'rapidx_user' => 'required|string',
            'access_level' => 'required|string',
            'user_section' => 'required|string',
        ]);

        // Prepare the data for insertion or update
        $insertData = [
            'rapidx_id' => $request->rapidx_user,
            'access_level' => $request->access_level,
            'section' => $request->user_section,
            'created_at' => now(), // Use Laravel's now() helper
            'logdel' => 0,
        ];

        $updateData = [
            'rapidx_id' => $request->rapidx_user,
            'access_level' => $request->access_level,
            'section' => $request->user_section,
            'updated_at' => now(), // Use Laravel's now() helper
            'logdel' => 0,
        ];

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Check if the record already exists
            $checkIfAlreadyExist = UserAccess::where('rapidx_id', $request->rapidx_user)->exists();

            if ($checkIfAlreadyExist) {
                // Record exists, update it
                if (isset($request->user_details_id)) {
                    UserAccess::where('id', $request->user_details_id)->update($updateData);
                    DB::commit(); // Commit transaction after update
                    return response()->json(['result' => 'Record updated successfully.'], 200);
                } else {
                    return response()->json(['result' => 'Record already exists.'], 409); // Conflict
                }
            } else {
                // Record does not exist, insert it
                UserAccess::create($insertData); // Use create for mass assignment
                DB::commit(); // Commit transaction after insert
                return response()->json(['result' => 'Record created successfully.'], 201);
            }
        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaction on error
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function loadRapidXSectionHead(Request $request){   

        $user_id = $_SESSION['rapidx_user_id'];

        $user_details = RapidXUser::where('id', $user_id)->get();

        // return $user_details;

        $user_section = UserAccess::where('rapidx_id', $user_id)->get();

        // return $user_section;

        if(count($user_details) > 0){
            $users = UserAccess::with(['rapidx_user_details' => function($query) use ($user_details){

            $query->where('user_stat',1)->orderBy('name','asc');

            // return $query;

        }])->whereIn('access_level',[2])->where('section', $user_section[0]->section)->where('logdel', 0)->get();

            // return $users;

            $users_final = $users->where('rapidx_user_details', '!=', null)->flatten(1);


            return response()->json(['users' => $users_final]);
        }
        else
        {
            return response()->json(['users' => []]);
        }

        
    }

    public function loadKakampink(Request $request){
        $user_id = $_SESSION['rapidx_user_id'];

        $user_section = UserAccess::where('rapidx_id', $user_id)->get();

        $kakampink_section = $user_section[0]->section;

        if(count($user_section) > 0){
            $kakampink = UserAccess::with(['rapidx_user_details'])
            ->where('section', $kakampink_section)
            ->where('rapidx_id', '!=', $user_id)
            ->where('access_level', 1)
            ->where('logdel', 0)
            ->get();

            return response()->json(['kakampink' => $kakampink]);
        }else{
            return response()->json(['users' => []]);
        }

    }

    public function loadFasEngineers(Request $request){
        // $user_id = $_SESSION['rapidx_user_id'];

        // $user_section = UserAccess::where('rapidx_id', $user_id)->get();

        // $kakampink_section = $user_section[0]->section;

        $fasEngineers = UserAccess::with(['rapidx_user_details'])
        ->where('section','FAS')
        // ->where('rapidx_id', '!=', $user_id)
        ->where('access_level', 3)
        ->where('logdel', 0)
        ->get();

        return response()->json(['fasEngineers' => $fasEngineers]);
    }

    public function getUserAccess(Request $request){
        $data = $request->all();

        $userDetails = UserAccess::with(['rapidx_user_details'])
        ->where('logdel', 0)
        ->where('id', $request->user_id)
        ->get();

        // return $userDetails;

        return response()->json(['userDetails' => $userDetails]);

    }

    public function deactivateUser(Request $request){
        $data = $request->all();

        DB::beginTransaction();

        $updateData = [
            'updated_at' => now(), // Use Laravel's now() helper
            'logdel' => 1,
        ];

        UserAccess::where('id', $request->user_id)->update($updateData);
        DB::commit(); // Commit transaction after insert
        return response()->json(['result' => 1]);
    }

   
}
