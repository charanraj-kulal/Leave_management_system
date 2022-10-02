<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLeaveApplicationRequest;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use DateTime;
use App\Mail\EmailRejectionStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailApprovalStatus;
use App\Mail\EmailIntegration;
use Carbon\Carbon;
use Validator;

class LeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   


    //For leave application (casual leave)
    public function store(Request $request)
    {
        $request->validate([
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date', 'after_or_equal:start_date'],
            'reason'        => ['required', 'string', 'max:255'],           
        ],[
                'start_date.required' => 'Start date is required',
                'end_date.required' => 'You are selected invalid end date',
                'reason.required' => 'Reason is required'
            ]
    );
        
        $halfday=0.5;
        $application = new LeaveApplication();
        $application->reason = $request->reason;//['reason'];
        $application->applier_user_id = Auth::id();
        $application->applier_user_name = Auth::user()->name;
        $application->start_date = new Carbon($request->input('start_date'));
        $application->end_date = new Carbon($request->input('end_date'));
        //$application->applier_user_email=Auth::user()->email;
        $start_date =  new Carbon($request->input('start_date'));
        $end_date = new Carbon($request->input('end_date'));
        $application->half_day_session = $request->half_day_session;
        $date1 = strtotime($application->start_date);
        $date_start= date('Y-m-d',$date1);
      
        if ($request->has('halfday')==1){
            $application->number_of_days = 0.5;
            $application->end_date = new Carbon($request->input('start_date'));
        }
        else{
            //for excluding sunday calculation

            $a =$start_date->diff($end_date)->d+1;            
            $sundays = intval(  $a / 7) + ($start_date->format('N') + $a % 7 > 7);            


            $application->number_of_days = $a-$sundays;
            
        }   
      
       $date =  \App\Models\LeaveApplication::select('start_date')->where('applier_user_id',$application->applier_user_id)->where('start_date',$date_start)->get();

       if(count($date) == 1) {
          Session::Flash('danger', 'You applied casual leave for same date.');  
          return redirect()->back();
       }
      
      else{
         $application->save(); // Saves in database
         $applier_name = $application->applier_user_name;
         $date = date("d-m-Y");
            //For mail function
        Mail::send('application-email-template', 
        
        array( 
            'applier_user_name'=>$application->applier_user_name,

            'reason' => $request->get('reason'), 

            'start_date' => $request->get('start_date'), 

            'end_date' => $request->get('end_date'), 

            'number_of_days' =>$application->number_of_days,

            'email' => Auth::user()->email,

            'half_day_session' =>$application->half_day_session,
            
            

        ), 
        
        function($message) use ($request,$applier_name,$date){ 

            
            $message->from('lms.project2022.23@gmail.com');
            $to_mail=array('charanraj9731@gmail.com');
            $message->to($to_mail)->subject("New leave application from $applier_name on $date"); 

        }); 

        //success message after submitting the casual leave application
        Session::Flash('success', 'Application Submitted Successfully.'); 

      // Routes
       if(auth()->user()->user_group_id == 1) {
        return redirect()->intended('/');}
        elseif(auth()->user()->user_group_id == 2) {
            return redirect()->intended('manager');}
            elseif(auth()->user()->user_group_id == 4){
                return redirect()->intended('employee');}    
      }
    }
//For status Update
    public function update(Request $request, LeaveApplication $application)
    {
        
        $application->authorizer_user_id = Auth::id();

        if($request->has('approved')) {
            $application->status = 'approved';
        } else {
            $application->status = 'rejected';
        }
        $application->save();

        $applier = User::findOrFail($application->applier_user_id);
        if($request->has('approved')) {
            $emails = $applier;
            $to = $emails['email'];
            //Approval mail status
            Mail::send('leave-approved-email', 
        
        array( 
            

            'reason' => $application->reason, 

            'start_date' => $application->start_date, 

            'end_date' => $application->end_date, 

            'number_of_days' =>$application->number_of_days,           
            

        ), 

        function($message) use ($request,$to){ 
            
            $message->from('lms.project2022.23@gmail.com');
            $to_mail=$to;
            $message->to($to_mail)->subject("Casual Leave Status "); 

        }); 
            
            Session::Flash('success', 'You approved the casual leave.');
        } else {
            //Rejection mail status
            $emails = $applier;
            $to = $emails['email'];
            //Approval mail status
            Mail::send('leave-rejection-email', 
        
        array( 
            

            'reason' => $application->reason, 

            'start_date' => $application->start_date, 

            'end_date' => $application->end_date, 

            'number_of_days' =>$application->number_of_days,           
            

        ), 

        function($message) use ($request,$to){ 
            
            $message->from('lms.project2022.23@gmail.com');
            $to_mail=$to;
            $message->to($to_mail)->subject("Casual Leave Status"); 

        }); 


            
           // Mail::to($emails)->send(new EmailRejectionStatus);
            
    
            Session::Flash('success', 'You rejected the application.');
        }

        return redirect()->back();

    }
}
 
    
     
