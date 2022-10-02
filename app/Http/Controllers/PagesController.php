<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PublicLeaveApplication;
use App\Models\PublicLeave;
use App\Models\LeaveTypeSales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
// For leave calculation
//for Development department leave view in dashboard
    public function leaveView()
    {
        $types = LeaveType::all(); //Model(Leave days)
        $data['types'] = $types;
        $apps1 = LeaveApplication::myApplications()//Model(Casual leave application)
        ->where('status', 'approved')
        ->addLeaveType()
        ->get();
        $apps2 = PublicLeaveApplication::myApplications()//Model(Public leave application)
        ->where('status', 'approved')
        ->addLeaveType()
        ->get();
         $apps3 = PublicLeaveApplication::myApplications()->where('status', 'approved')->count();
        // print_r($apps3); exit();
        
        foreach ($types as $type) {
            $data['leaveCount'][$type->type] = 0;
        }
        foreach ($apps1 as $app) {
            $data['leaveCount'][$app->type] += $app->number_of_days;//for total count of Casual leave approved
        }
        foreach ($apps2 as $app) {
            $data['leaveCount'][$app->type] += $app->number_of_days; //for total count of Public leave approved
        }
        //For application view
        $data['myApplications'] = LeaveApplication::MyApplications() // This the view for Casual leave applied by user
        ->AddLeaveType()->Paginate(30);
        

        $data['leaveStat'] = LeaveApplication::MyApplications()
        ->select('status', DB::raw('count(status) as total'))
        ->groupBy('status')
        ->pluck('total','status');
        
    //Returns to the view

    if((auth()->user()->user_group_id == 1)&&(auth()->user()->status == 'active')) {
        return view('admin', $data);}

        elseif((auth()->user()->user_group_id == 1)&&(auth()->user()->status == 'notice_period')) { 
            return view('notice_period',$data);}

        elseif((auth()->user()->user_group_id == 2)&&(auth()->user()->status == 'active')) {
            return view('manager', $data);}

            elseif((auth()->user()->user_group_id == 2)&&(auth()->user()->status == 'notice_period')) { 
                return view('notice_period',$data);}

                elseif((auth()->user()->user_group_id == 4)&&(auth()->user()->status == 'active')){
                    return view('employee', $data);}

                    elseif((auth()->user()->user_group_id == 4)&&(auth()->user()->status == 'notice_period')) { 
                        return view('notice_period', $data);}

                       

        // if(auth()->user()->user_group_id == 1) {
        //     return view('admin', $data);}
        //     // elseif(auth()->user()->user_group_id == 5){
        //     //     return view('sales_employee', $data);} 
        //     elseif(auth()->user()->user_group_id == 2) {
        //         return view('manager', $data);}
        //         elseif(auth()->user()->user_group_id == 4){
        //             return view('employee', $data);}  
                    
    }
    


    public function leaveApplicationView()
    {
        $data['leaveTypes'] = LeaveType::all();
        return view('leaveapplication', $data);
    }
    //For admin and manager Managing the applications
    public function actionView()
    {
       // print_r("hi");exit;
        $data['applications'] = LeaveApplication::where('leave_applications.status', 'pending')
        
        ->join('users', 'users.id', '=', 'leave_applications.applier_user_id')
       // print_r($data['applications']);exit;
        ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
        ->select(
            'leave_applications.id as id', 
            'leave_applications.reason',
            'leave_applications.number_of_days',
            'users.name as applier_name',
            'leave_applications.start_date',
            'leave_applications.end_date',
            'leave_applications.status',
            'leave_types.type as leave_type',
            'leave_applications.created_at',
            'leave_applications.half_day_session'
        )->orderBy('id','desc')->Paginate(15); 
        
          //  print_r($data);exit;
        return view('action', $data);
    }

    //for deleting the Casual leave application
    public function casualLeaveDestroy($id)
    {   
        $casual_leave_application = LeaveApplication::MyApplications()->where('id',$id);     
        $casual_leave_application->delete();
        return redirect('/')->with('success', 'Casual Leave Application has been deleted');
    }
    //For Public leave view
    public function publicLeaveView()
    {
        $public_leave = PublicLeave::get(); 
        
        $public_leave_apply = PublicLeaveApplication::get(); 
        

        
        return view('public-leave-application', compact('public_leave','public_leave_apply'));
        

    }
    //For deleting or cancel the Public Leave application
    public function publicLeaveDestroy($id,$public_leave_id) //need to pass user id as well as public leave id
    {   
        $public_leave_application = PublicLeaveApplication::where('applier_user_id',$id)->where('leave_type_id',2)->where('public_leave_id',$public_leave_id)
        ->where('number_of_days',1);    
         
        $public_leave_application->delete();
        return redirect()->back()->with('success', 'Public Leave Application has been deleted');
    }   
    //Approved casual leave application view
    public function approvedView(Request $request)
    {
        $search = $request['search'] ?? "";
        
        
     
        
        // for search by date
        if($search != "") {
           
            $data = LeaveApplication::where('status', 'approved')->where('start_date','LIKE',"%$search%")->Paginate(15);
            
         
            if($data->count() == 0) {   
                
                return view('casual-leave-approved-list',compact('data'),['public_leave_name'=>$data])->withErrors(['search_not_matched' => 'No Information found']);
            }
        } 
       
        else if($search == "") 
        {
          
            $data = LeaveApplication::where('status', 'approved')->orderBy('id', 'desc')->Paginate(15);  
        }

        $search_data = compact('data');



        $data = LeaveApplication::where('status', 'approved')->orderBy('id', 'desc')->Paginate(15); 
        
        

        return view('casual-leave-approved-list', ['data' =>$data])->with($search_data);
    }
//Casual leave rejected list
    public function rejectedView()
    {
        $data['applications'] = LeaveApplication::where('leave_applications.status', 'rejected')

        
        ->join('users', 'users.id', '=', 'leave_applications.applier_user_id')
        
        ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
        ->select(
            'leave_applications.id as id', 
            'leave_applications.reason',
            'leave_applications.number_of_days',
            'users.name as applier_user_name',
            'leave_applications.start_date',
            'leave_applications.end_date',
            'leave_applications.status',
            'leave_types.type as leave_type',
            'leave_applications.created_at',
            'leave_applications.half_day_session'
        )->orderBy('id','desc')->Paginate(15);
        

        return view('casual-leave-rejected-list', $data);
    }
// for casual leave exceeded list
    public function exceedCasualLeaveView()
    {
        $user = Auth::user()->get();
        //print_r($user);exit();
        $types = LeaveType::all(); //Model(Leave days)
        $data['types'] = $types;
        $apps1 = LeaveApplication::where('status', 'approved')
        ->get();
        //print_r($apps1);exit();        
        foreach ($types as $type) {
            $data['leaveCount'][$type->type] = 0;
        }
        foreach ($apps1 as $app) {
            $data['leaveCount'][$app->type] += $app->number_of_days;//for total count of Casual leave approved
        }
        
        

        $data['leaveStat'] = LeaveApplication::
        select('status', DB::raw('count(status) as total'))
        ->groupBy('status')
        ->pluck('total','status');

        print_r($data['leaveStat']);exit();
        return view('casual_leave_exceeded_list', ['data' => $data, 'user' => $user]);
    }
//For public leave applied list
    public function publicLeaveStatusView(Request $request) 
    {
        $search = $request['search'] ?? "";
        

        // If search is not empty display searched catgeories else display all categories
        if($search != "") {
           
            $data = PublicLeaveApplication::orderBy('id', 'desc')->where('public_leave_date','LIKE',"%$search%")->Paginate(15);
            
         
            if($data->count() == 0) {   
                
                return view('public_leave_applied_status',compact('data'),['public_leave_name'=>$data])->withErrors(['search_not_matched' => 'No Information found']);
            }
        } 
       
        else if($search == "") 
        {
          
            $data = PublicLeaveApplication::orderBy('id', 'desc')->Paginate(15);  
        }

        $search_data = compact('data');

       
        $data = PublicLeaveApplication::where('status', 'approved')->orderby('public_leave_date','desc')->Paginate(15);
        
       // $search_data = compact('data','s_title','s_cat');
       // return view('viewArticle',['categories'=>$data,'category'=>$category])->with($search_data);
        return view('public_leave_applied_status', ['data' => $data])->with($search_data);
    }

    //public function tomorrowLeaveStatusView() 
    //{
       

     //   $data1 = LeaveApplication::where('status', 'approved')->orderby('start_date','desc')->Paginate(15);
      //	$r_date = strtotime("tomorrow");
      //  $t_date = date('Y-m-d', $r_date);
      //  $data2 = PublicLeaveApplication::where('status', 'approved')->where('public_leave_date', $t_date)->orderby('public_leave_date','desc')->Paginate(15);
      //  $data = (object) array_merge((array) $data1, (array) $data2);
        //print_r($data);exit;
      
      //  return view('tomorrow_leave_status', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
   // }
  
  public function monthLeaveStatusView() 
    {
       
        $now_date = date('d-m-Y');
        $now_date = strtotime($now_date);
        $now_date = strtotime("+30 day", $now_date);
        $now_date = date('Y-m-d', $now_date);        
        $today_date = date('Y-m_d');

        $data1 = LeaveApplication::where('status', 'approved')->where('end_date', '>=', $today_date)->orderby('start_date','asc')->Paginate(15);
      
        //print_r($application->public_leave_date);exit;
         //$today_date = strtotime($today_date);
        $data2 = PublicLeaveApplication::where('status', 'approved')->where('public_leave_date', '>=', $today_date)->where('public_leave_date', '<=', $now_date)->orderby('public_leave_date','asc')->Paginate(15);
        $data = (object) array_merge((array) $data1, (array) $data2);
        //print_r($data2);exit;
        return view('/month_leave_status', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }

    public function allEmployeeLeaveStatusView() 
    {
        $now_date = date('d-m-Y');
        $now_date = strtotime($now_date);
        $now_date = strtotime("+30 day", $now_date);
        $now_date = date('Y-m-d', $now_date);        
        $today_date = date('Y-m-d');

        $data1 = LeaveApplication::distinct()->where('status', 'approved')->distinct()->Paginate(20); 
        $users = LeaveApplication::all()->where('status', 'approved');
        $usersUnique = $users->unique('applier_user_id');   
        //print_R($usersUnique); exit;  
        $data2 = PublicLeaveApplication::where('public_leave_date', '<', $today_date)->orderby('applier_user_id','asc')->Paginate(20);
       // print_r($data2);exit;
        $data = (object) array_merge((array) $data1, (array) $data2);
        //print_r($data2);exit;

     //   $count_approved =  LeaveApplication::select('approved')->where('applier_user_id',$usersUnique)->get();

      //  print_r($count_approved);exit;
      $users2 = PublicLeaveApplication::all()->where('status', 'approved')->where('public_leave_date', '<', $today_date);
      
        $usersUnique2 = $users2->unique('applier_user_id'); 
        //print_r($usersUnique2);exit;
        return view('/leave-status-all-employee', ['data' => $data, 'usersUnique' => $usersUnique, 'usersUnique2' =>$usersUnique2, 'data2' => $data2]);
    }
//for sales department leave view in dashboard
    public function salesLeaveView()
    {
        $types = LeaveTypeSales::all(); //Model(Leave days)
        $data['types'] = $types;
        $apps1 = LeaveApplication::myApplications()//Model(Casual leave application)
        ->where('status', 'approved')
        ->addLeaveType()
        ->get();
        $apps2 = PublicLeaveApplication::myApplications()//Model(Public leave application)
        ->where('status', 'approved')
        ->addLeaveType()
        ->get();
         $apps3 = PublicLeaveApplication::myApplications()->where('status', 'approved')->count();
        // print_r($apps3); exit();
        
        foreach ($types as $type) {
            $data['leaveCount'][$type->type] = 0;
        }
        foreach ($apps1 as $app) {
            $data['leaveCount'][$app->type] += $app->number_of_days;//for total count of Casual leave approved
        }
        foreach ($apps2 as $app) {
            $data['leaveCount'][$app->type] += $app->number_of_days; //for total count of Public leave approved
        }
        //For application view
        $data['myApplications'] = LeaveApplication::MyApplications() // This the view for Casual leave applied by user
        ->AddLeaveType()->Paginate(30);
        

        $data['leaveStat'] = LeaveApplication::MyApplications()
        ->select('status', DB::raw('count(status) as total'))
        ->groupBy('status')
        ->pluck('total','status');
        
    //Returns to the view
        if((auth()->user()->user_group_id == 5)&&(auth()->user()->status == 'active'))
            {
                //  print_r("hicall"); exit;
                return view('sales_employee', $data);
            }

                elseif((auth()->user()->user_group_id == 5)&&(auth()->user()->status == 'notice_period')) 
                { 
                    return view('notice_period', $data);
                }
    
    }
//this will show all users and their status
    public function employeeStatus() 
    {

        $employee_status = User::orderby('id','asc')->Paginate(15);
        
        return view('EmployeeStatus/employee_status', [ 'employee_status' => $employee_status]);
    }
//edit view of users and their status
    public function editEmployeeStatus($id) 
    {
        $employee_details = user::findOrFail($id);
        
        return view('EmployeeStatus/edit_employee_status', compact('employee_details'));        
        
    }
//Updation of users and their status
    public function updateEmployeeStatus($id, Request $request) 
    {  
            $employee_status = User::orderby('id','asc')->Paginate(15);

            $updateData= User::Find($request->id);
          
            $updateData->name=$request->name;
          
            $updateData->email=$request->email;
           
            $updateData->status=$request->status;
          
            $updateData->user_group_id=$request->user_group_id;

            $updateData->save();       
            
        Session::Flash('success', 'User status has been updated.');
        return redirect('/employee_status/manage');

      
    }

    
}

