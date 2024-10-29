<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function getAnalytics(Request $request){
        $repo_files = DB::connection('mysql')
        ->table('repositories')
        ->get('id');

        $file_count_active = $repo_files->whereNull('deleted_at')->count('id');
        $file_count_archive = $repo_files->whereNotNull('deleted_at')->count('id');

        $jap_files = DB::connection('mysql')
        ->table('japanese_records')
        ->get();

        $jap_count_active = $jap_files->whereNull('deleted_at')->count('id');
        $jap_count_inactive = $jap_files->whereNotNull('deleted_at')->count('id');

        return response()->json([
            'file_count_active' => $file_count_active,
            'file_count_archive' => $file_count_archive,
            'jap_count_active' => $jap_count_active,
            'jap_count_inactive' => $jap_count_inactive
        ]);
    }

    public function getDataById(Request $request){
        return DB::connection('mysql')
        ->table($request->table)
        ->where('id', $request->id)
        ->select('*')
        ->first();

    }

    public function changeStatus(Request $request){

        date_default_timezone_set('Asia/Manila');
        DB::beginTransaction();
        
        try{
            $update_array = array(
                'updated_by' => $_SESSION['rapidx_employee_number'],
                'updated_at' => NOW()
            );
    
            if($request->status == 1){ // archive
                $update_array['deleted_at'] = NOW();
    
            }
            else{ // active
                $update_array['deleted_at'] = null;
            }
    
            DB::connection('mysql')
            ->table($request->table)
            ->where('id', $request->id)
            ->update($update_array);

            DB::commit();

            return response()->json([
                'result' => 1,
                'msg' => 'Transaction Successful'
            ]);


        }catch(Exemption $e){
            DB::rollback();
            return $e;
        }
    }

    public function sdms($username){
        return $username;
        // $rapidx_user = DB::connection('mysql_rapidx')
        // ->table('users')
        // ->where('username', "$username")
        // ->first();

        // if(isset($rapidx_user)){
        //     Auth::loginUsingId($rapidx_user->id);
        // }

        // return route('/');

    }
}
