<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\NewLeaveApplicationRequest;
use App\Models\PublicLeaveApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\Models\PublicLeave;
use App\Models\LeaveType;


class PublicLeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   


    //For leave application (Public holiday leave)
    public function store(Request $request)
    { 
    
        $public_holiday = new PublicLeaveApplication();     
           
        $public_holiday->applier_user_id = Auth::id();
        $public_holiday->applier_user_name = Auth::user()->name;        
        $public_holiday->public_leave_id = $request->id;
        $public_holiday->public_leave_name = $request->name;
        
        $public_holiday->public_leave_date = $request->date;
        $public_holiday->number_of_days = 1; // this is the condition when application applied then number_of_days =1
        
        $count_of_public = PublicLeaveApplication::select('applier_user_id')->where('applier_user_id',$public_holiday->applier_user_id)->get();

        

        if(count($count_of_public)<3){
        $public_holiday->save(); // Saves in database
        Session::Flash('success', 'Public leave applied successfully');
        } //for success message
       else{
        Session::Flash('danger', 'You already applied maximum number of public leave');

       }
       
       return redirect()->back();
      // Routes
    //    if(auth()->user()->user_group_id == 1) {
    //     return redirect()->back()->with('success', 'Public leave applied successfully');}
    //     elseif(auth()->user()->user_group_id == 2) {
    //         return redirect()->back()->with('success', 'Public leave applied successfully');}
    //         elseif(auth()->user()->user_group_id == 4){
    //             return redirect()->back()->with('success', 'Public leave applied successfully');}    
    }

    
}
