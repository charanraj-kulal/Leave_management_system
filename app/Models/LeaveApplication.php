<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
    ];

    public function applier()
    {
        // returns the id from User table and stores as applier user id
        return $this->hasOne(User::class, 'id', 'applier_user_id'); 
    }
    public function applier_name()
    {
        return $this->hasOne(User::class, 'name', 'applier_user_name');
    }

    public function getStartDateAttribute($value)
    {
        //For start date picker
        return (new Carbon($value))->toFormattedDateString();
    }
    public function getEndDateAttribute($value)
    {
        //For end date picker
        return ($value) ? (new Carbon($value))->toFormattedDateString() : $value;
    }

    public function getCreatedAtAttribute($value)
    {
        //For created at attributes
        return (new Carbon($value))->toFormattedDateString();
    }
   
    public function scopeMyApplications($query) // for saving the details with user id
    {
        return $query->where('leave_applications.applier_user_id', Auth::id())
        ->latest('leave_applications.id')
        ->select(
            'leave_applications.id as id', 
            'leave_applications.reason', 
            'leave_applications.number_of_days', 
            'leave_applications.start_date',
            'leave_applications.end_date', 
            'leave_applications.status',
            'leave_applications.authorizer_user_id',
            'leave_applications.updated_at',
            
        );
    }
    public function scopeAddLeaveType($query)
    {
        return $query->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
        ->addSelect('leave_types.type');
    }

    public static function get_number_of_days($id) {
        //  print_r($id);exit;
      $number_of_days = LeaveApplication::select('number_of_days')->where('status', 'approved')->where('applier_user_id',$id)->get();
    //  $usersUnique = $users->unique('applier_user_id');
     // $number_of_days = LeaveApplication::select(where('applier_user_id',$id)->get();
    //print_r($number_of_days['0']['number_of_days']);exit;
    $n_c_days = array();
     foreach($number_of_days as $n_days)
     {

     
     array_push($n_c_days,$n_days->number_of_days);

     }
   // print_r(array_sum($n_c_days));
      return array_sum($n_c_days);
      
  }
    
}