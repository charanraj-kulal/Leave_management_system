<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLeaveApplicationRequest;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use dateTime;
use App\Mail\EmailRejectionStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailApprovalStatus;
use App\Mail\EmailIntegration;
use Carbon\Carbon;
use Validator;

class ManualLeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   


    //For leave application (casual leave)
    public function manualStore(Request $request)
    {
        $data= Auth::user()->get();
        
       return view('casual-leave-admin-employee',$data);
    }

}
 
    
     
