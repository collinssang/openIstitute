<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('leaveStatuses', App\Http\Controllers\LeaveStatusController::class);

Route::resource('leaveTypes', App\Http\Controllers\LeaveTypeController::class);

Route::resource('leaveDays', App\Http\Controllers\LeaveDaysController::class);

Route::resource('leaves', App\Http\Controllers\LeaveController::class);

Route::get('/leaves_lists', [App\Http\Controllers\LeaveController::class, 'index2']);
Route::get('/leaves_notice', [App\Http\Controllers\LeaveController::class, 'leavesNotice']);
Route::get('/entitled_leave_days', [App\Http\Controllers\LeaveDaysController::class, 'index']);
Route::get('/leave_request', [App\Http\Controllers\LeaveController::class, 'leave_requests']);

Route::post('/approve_leave/{id}', [App\Http\Controllers\LeaveController::class, 'leaveApprovalReject']);

Route::post('/reject_leave/{id}', [App\Http\Controllers\LeaveController::class, 'leaveApprovalReject']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
