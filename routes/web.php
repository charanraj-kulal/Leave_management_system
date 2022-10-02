<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveTypeSalesController;
use App\Http\Controllers\PublicLeaveController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LeaveApplicationController;
use App\Mail\EmailIntegration;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PublicLeaveApplicationController;
use App\Http\Controllers\ManualLeaveApplicationController;


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
    return view('auth/login');
});

//This will be route for google auth page /this will go  to GoogleController and go to redirectToGoogle method
Route::get('auth/google',[GoogleController::class, 'redirectToGoogle']); 
//This will be route for google callback page /this will go  to GoogleController and go to handleGoogleCallback method
Route::get('auth/google/callback',[GoogleController::class, 'handleGoogleCallback']);
Route::get('login',[GoogleController::class, 'login']);
//Route for logout
Route::get('logout',[GoogleController::class, 'logout']);

//This is the auto generated for Auth
Auth::routes();
//This rote related to Middleware


Route::group(['middleware' => 'auth'], function () {
        
    Route::group(['middleware' => 'is_admin'], function () {    
        //Route for Admin Dashboard        
        Route::get('/', [HomeController::class, 'admin'])->name('admin_dashboard');
        // Route for leave Type page
        //adding the leave type
        // Route::post('leavetype/add', [LeaveTypeController::class, 'store'])->name('add.leavetype');
        // Route::get('leavetype/add', [LeaveTypeController::class, 'create'])->name('add.leavetype');
        // Route::post('leavetypeforsales/add', [LeaveTypeSalesController::class, 'store'])->name('add.leavetype');
        // Route::get('leavetypeforsales/add', [LeaveTypeSalesController::class, 'create'])->name('add.leavetype');
        
        // //Manage view
        // Route::get('leavetype/manage', [LeaveTypeController::class, 'viewLeaveType'])->name('manage.leavetype');
        // Route::get('leavetypeforsales/manage', [LeaveTypeSalesController::class, 'viewLeaveType'])->name('manage.leavetype');
        // //Edit the Leave type
        // Route::get('leavetype/edit/{id}', [LeaveTypeController::class, 'edit'])->name('edit.leavetype');
        // Route::post('leavetype/edit/{id}', [LeaveTypeController::class, 'update'])->name('edit.leavetype');
        // Route::get('leavetypeforsales/edit/{id}', [LeaveTypeSalesController::class, 'edit'])->name('edit.leavetype');
        // Route::post('leavetypeforsales/edit/{id}', [LeaveTypeSalesController::class, 'update'])->name('edit.leavetype');
        // //Delete the leave type
        // Route::get('leavetype/delete/{id}', [LeaveTypeController::class, 'destroy'])->name('delete.leavetype');
        // Route::get('leavetypeforsales/delete/{id}', [LeaveTypeSalesController::class, 'destroy'])->name('delete.leavetype');

        // // Route for Public leave page
        // //adding the Public leave
        // Route::post('publicleave/add', [PublicLeaveController::class, 'store'])->name('add.publicleave');
        // Route::get('publicleave/add', [PublicLeaveController::class, 'create'])->name('add.publicleave');
        // //Manage view
        // Route::get('publicleave/manage', [PublicLeaveController::class, 'viewPublicLeave'])->name('manage.publicleave');
        // //Edit the Public leave
        // Route::get('publicleave/edit/{id}', [PublicLeaveController::class, 'edit'])->name('edit.publicleave');
        // Route::post('publicleave/edit/{id}', [PublicLeaveController::class, 'update'])->name('edit.publicleave');
        // //Delete the Public leave
        // Route::get('publicleave/delete/{id}', [PublicLeaveController::class, 'destroy'])->name('delete.publicleave');

    });
        //Route for Manager
        Route::group(['middleware' => 'is_manager'], function () {            
        Route::get('/manager', [HomeController::class, 'manager'])->name('manager_dashboard');
        
        
    });
    //Route for Employee
    Route::group(['middleware' => 'is_employee'], function () {            
        Route::get('/employee', [HomeController::class, 'employee'])->name('employee_dashboard');
    });
    //Route for Sales Employee
    Route::group(['middleware' => 'is_salesemployee'], function () {            
        Route::get('/dashboard', [HomeController::class, 'sales_employee'])->name('salesemployee_dashboard');
    });
    
            
});

 //adding the leave type
 Route::post('leavetype/add', [LeaveTypeController::class, 'store'])->name('add.leavetype');
 Route::get('leavetype/add', [LeaveTypeController::class, 'create'])->name('add.leavetype');
 Route::post('leavetypeforsales/add', [LeaveTypeSalesController::class, 'store'])->name('add.leavetype');
 Route::get('leavetypeforsales/add', [LeaveTypeSalesController::class, 'create'])->name('add.leavetype');
 
 //Manage view
 Route::get('leavetype/manage', [LeaveTypeController::class, 'viewLeaveType'])->name('manage.leavetype');
 Route::get('leavetypeforsales/manage', [LeaveTypeSalesController::class, 'viewLeaveType'])->name('manage.leavetype');
 //Edit the Leave type
 Route::get('leavetype/edit/{id}', [LeaveTypeController::class, 'edit'])->name('edit.leavetype');
 Route::post('leavetype/edit/{id}', [LeaveTypeController::class, 'update'])->name('edit.leavetype');
// Route::get('leavetypeforsales/edit/{id}', [LeaveTypeSalesController::class, 'edit'])->name('edit.leavetype');
 //Route::post('leavetypeforsales/edit/{id}', [LeaveTypeSalesController::class, 'update'])->name('edit.leavetype');
 //Delete the leave type
 Route::get('leavetype/delete/{id}', [LeaveTypeController::class, 'destroy'])->name('delete.leavetype');
 Route::get('leavetypeforsales/delete/{id}', [LeaveTypeSalesController::class, 'destroy'])->name('delete.leavetype');

 // Route for Public leave page
 //adding the Public leave
 Route::post('publicleave/add', [PublicLeaveController::class, 'store'])->name('add.publicleave');
 Route::get('publicleave/add', [PublicLeaveController::class, 'create'])->name('add.publicleave');
 //Manage view
 Route::get('publicleave/manage', [PublicLeaveController::class, 'viewPublicLeave'])->name('manage.publicleave');
 //Edit the Public leave
 Route::get('publicleave/edit/{id}', [PublicLeaveController::class, 'edit'])->name('edit.publicleave');
 Route::post('publicleave/edit/{id}', [PublicLeaveController::class, 'update'])->name('edit.publicleave');
 //Delete the Public leave
 Route::get('publicleave/delete/{id}', [PublicLeaveController::class, 'destroy'])->name('delete.publicleave');








//For leave application
Route::get('/apply', [PagesController::class, 'leaveApplicationView'])->name('applyView');
Route::post('/apply', [LeaveApplicationController::class, 'store'])->name('store');

// In dashboard showing available leave
Route::get('/', [PagesController::class, 'leaveView'])->name('homeView');
Route::get('admin', [PagesController::class, 'leaveView'])->name('homeView');
Route::get('manager', [PagesController::class, 'leaveView'])->name('homeView');
Route::get('employee', [PagesController::class, 'leaveView'])->name('homeView');
Route::get('notice_period', [PagesController::class, 'leaveView'])->name('homeView');
//Route::get('user_blocked', [PagesController::class, 'leaveView'])->name('homeView');
// Route::get('/', [PagesController::class, 'salesLeaveView'])->name('homeViewSales');
Route::get('dashboard', [PagesController::class, 'salesLeaveView'])->name('homeViewSales');
//For deleting the application
Route::get('/delete/{id}', [PagesController::class, 'casualLeaveDestroy'])->name('delete.casual_leave');

//For action of leave application
Route::get('/action', [PagesController::class, 'actionView'])->name('actionView');
Route::post('/action/{application}', [LeaveApplicationController::class, 'update'])->name('update');
//view for public holiday application
Route::get('/public_leave', [PagesController::class, 'publicLeaveView']);
Route::get('/public_leave/{id}/{name}/{date}', [PublicLeaveApplicationController::class, 'store'])->name('apply_public_leave');
//for delete the public leave
Route::get('/cancel/{applier_id}/{id}', [PagesController::class, 'publicLeaveDestroy'])->name('delete.public_leave');

Route::get('/apply/manual', [ManualLeaveApplicationController::class, 'manualStore'])->name('manual_store');

// For Reports
//for casual leave approved list
Route::get('/casual_leave_approved_list', [PagesController::class, 'approvedView']);
//Fr casual leave rejected list
Route::get('/casual_leave_rejected_list', [PagesController::class, 'rejectedView']);
//For casual leave exceeded list
Route::get('/casual_leave_exceeded', [PagesController::class, 'exceedCasualLeaveView']);
//for public leave applied list
Route::get('/public_leave_status', [PagesController::class, 'publicLeaveStatusView']);

//Route::get('/tomorrow_leave_status', [PagesController::class, 'tomorrowLeaveStatusView']);
//for 30 days leave status
Route::get('/month_leave_status', [PagesController::class, 'monthLeaveStatusView']);
//for all employees leave status
Route::get('/employee_leave_status', [PagesController::class, 'allEmployeeLeaveStatusView']);

//view employee status
Route::get('employee_status/manage', [PagesController::class, 'employeeStatus'])->name('manage.employee');
 //Edit the Employee status
 Route::get('employee_status/edit/{id}', [PagesController::class, 'editEmployeeStatus'])->name('edit.employee');
 Route::post('employee_status/edit/{id}', [PagesController::class, 'updateEmployeeStatus'])->name('edit.employee');
