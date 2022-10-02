<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PublicLeaveApplication extends Model
{
    use HasFactory;

    public function applier()
    {
        // returns the id from User table and stores as applier user id
        return $this->hasOne(User::class, 'id', 'applier_user_id'); 
    }

    public function applier_name()
    {
        return $this->hasOne(User::class, 'name', 'applier_user_name');
    }

    public function publicLeave()
    {
        // returns the id from User table and stores as applier user id
        return $this->hasMany(PublicLeave::class, 'id', 'public_leave_id'); 
    }

    public function getCreatedAtAttribute($value)
    {
        //For created at attributes
        return (new Carbon($value))->toFormattedDateString();
    }

    public function scopeMyApplications($query) // for saving the details with user id
    {
        return $query->where('public_leave_applications.applier_user_id', Auth::id())
                        ->join('public_leaves', 'public_leaves.id', '=', 'public_leave_applications.public_leave_id')
                        
                        ->latest('public_leave_applications.id')
                        ->select(
                            'public_leave_applications.id as id', 
                            'public_leave_applications.number_of_days',   
                            'public_leave_applications.status', 
                            'public_leave_applications.public_leave_id',
                            'public_leave_applications.public_leave_name',
                            
                        );
       
    }

    public function scopeAddLeaveType($query)
    {
       
        return $query->join('leave_types', 'leave_types.id', '=', 'public_leave_applications.leave_type_id')
        ->addSelect('leave_types.type');
       
    }

    public static function get_number_of_days($id,$public_leave_id) {

       
        $number_of_days = PublicLeaveApplication::where('applier_user_id',$id)->where('leave_type_id',2)->where('public_leave_id',$public_leave_id)
        ->where('number_of_days',1)->get();

       
        if(count($number_of_days) >=1) {
           return 1;
        } else {
            return 0;
        }
        
    }

    public static function get_public_number_of_days($id) {

        $today_date = date('Y-m-d');
       
        //  print_r($id);exit;
        $number_of_days1 = PublicLeaveApplication::select('number_of_days')->where('status', 'approved')->where('applier_user_id',$id)->where('public_leave_date', '<', $today_date)->get();
        //  $usersUnique = $users->unique('applier_user_id');
         // $number_of_days = LeaveApplication::select(where('applier_user_id',$id)->get();
        //print_r($number_of_days['0']['number_of_days']);exit;
        $n_c_days = array();
         foreach($number_of_days1 as $n_days)
         {
  
         
         array_push($n_c_days,$n_days->number_of_days);
  
         }
       // print_r(array_sum($n_c_days));
          return array_sum($n_c_days);

    
    
     
 }
    

}
