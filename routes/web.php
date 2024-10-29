<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\JoRequestController;
use App\Http\Controllers\JoRequestConformanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/sdms/{username}',[CommonController::class, 'sdms']);
Route::middleware('CheckSession')->group(function(){

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/jo_request_dashboard', function () {
        return view('jo_request_dashboard');
    })->name('jo_request_dashboard');

    Route::get('/jo_request', function () {
        return view('jo_request');
    })->name('jo_request');
    
    Route::get('/jo_request_conformance', function () {
        return view('jo_request_conformance');
    })->name('jo_request_conformance');

    Route::get('/user_access', function () {
        return view('user_access');
    })->name('user_access');

    Route::controller(UserAccessController::class)->group(function () {
        Route::get('/load_rapidx_user_list', 'loadRapidXUserList')->name('load_rapidx_user_list');
        Route::get('/load_rapidx_user_list_sectionhead', 'loadRapidXSectionHead')->name('load_rapidx_user_list_sectionhead');
        Route::get('/load_kakampink', 'loadKakampink')->name('load_kakampink');
        Route::get('/load_fas_engineers', 'loadFasEngineers')->name('load_fas_engineers');
        Route::get('/load_access_level', 'loadAccessLevel')->name('load_access_level');
        Route::post('/add_user_access', 'addUserAccess')->name('add_user_access');
        Route::get('/get_user_details', 'getUserAccess')->name('get_user_details');
        Route::get('/deactivate_user', 'deactivateUser')->name('deactivate_user');
    });

    Route::controller(JoRequestController::class)->group(function () {
        Route::get('/view_request_details', 'viewRequestDetails')->name('view_request_details');
        Route::get('/get_jo_records', 'getJORecords')->name('get_jo_records');
        Route::post('/add_jo_request', 'addJORequest')->name('add_jo_request');
        Route::post('/check_jo_request', 'checkedJORequest')->name('check_jo_request');
        Route::post('/approve_jo_request', 'approvedJORequest')->name('approve_jo_request');
        Route::get('/get_jo_request_details', 'getJoRequestDetails')->name('get_jo_request_details');
        Route::get('/complete_jo_request', 'completeJoRequest')->name('complete_jo_request');
        Route::get('/checked_jo_request_completion', 'checkedJoRequestForCompletion')->name('checked_jo_request_completion');
        Route::get('/approved_jo_to_complete', 'approvedJoToComplete')->name('approved_jo_to_complete');
        Route::get('/conformance_to_complete', 'conformanceToCompleteRequest')->name('conformance_to_complete');
        Route::get('/download_attachment/{request_id}', 'downloadAttachment')->name('download_attachment/{request_id}');
        
        Route::get('/get_ongoing_jo_request', 'getOngoingJoRequest')->name('get_ongoing_jo_request');
        Route::get('/get_completed_jo_request', 'getCompletedJoRequest')->name('get_completed_jo_request'); // count
        Route::get('/get_completed_jo_request_details', 'getCompletedJoRequestDetails')->name('get_completed_jo_request_details'); // count
        
    });

    Route::controller(JoRequestConformanceController::class)->group(function () {
        // Route::get('/view_requests_for_conformance', 'viewRequestsForConformance')->name('view_requests_for_conformance');
        Route::get('/get_conformance_details', 'getConformanceDetails')->name('get_conformance_details');
        Route::get('/conformance_by_kte', 'conformanceByKTE')->name('conformance_by_kte');
        Route::get('/conformance_by_jcp', 'conformanceByJCP')->name('conformance_by_jcp');
        Route::get('/conformance_by_ncp', 'conformanceByNCP')->name('conformance_by_ncp');
        Route::get('/disconformance_by_kte', 'disconformanceByKTE')->name('disconformance_by_kte');
        Route::get('/disconformance_by_jcp', 'disconformanceByJCP')->name('disconformance_by_jcp');
        Route::get('/disconformance_by_ncp', 'disconformanceByNCP')->name('disconformance_by_ncp');
        Route::post('/add_conformance_details', 'conformJoRequest')->name('add_conformance_details');
        // Route::post('/add_engineer', 'addEngineer')->name('add_engineer');

    });

    // 
});