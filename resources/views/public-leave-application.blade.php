@extends('layouts.app')

@section('content')<!-- for displaying Leave count status-->
    <!DOCTYPE html>
    <html>
        <head>
        <title>Apply for public leave - LMS</title>
        </head>
 <div class="content-wrapper mt-3 ">
    <?php if(auth()->user()->status == 'notice_period') : ?>
        <div class="col-md-12" >
          <h3 style = "color:red" >  You are in notice period!. You are not allowed to apply for any Public leaves. </h3>
        </div>
     <?php endif; ?>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>Apply for Public Holiday</strong></h3>                
                </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    
                                    <th>Holiday</th>
                                    <th>Date</th>                                
                                    <th>Status</th>   
                                    <th>Action </th>                           
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($public_leave ->sortBy('date') as $index => $public_holiday)
                            
                                    <tr>
                                        
                                        
                                        <td>{{ $public_holiday->name }}</td>
                                        <?php $date=strtotime($public_holiday->date); $date1 = date("d-m-Y - l",$date); ?>
                                        <td>{{$date1}}</td>
                                        

                                            @csrf
                                            <input  type="hidden" class="apply_val_id" value="{{ $public_holiday->name }}"/>
                                                                         
                                            <?php $value = \App\Models\PublicLeaveApplication::get_number_of_days(Auth::id(),$public_holiday->id); ?>
                                            
                                            <td class="col-md-1">
                                                <?php if($public_holiday->type != 'constant'){ ?>
                                                <input type="checkbox" name="checked" {{ $value ? 'checked' : ''}}   class="form-control" />
                                                <?php } elseif ($public_holiday->type == 'constant') { ?>
                                                    <input type="checkbox" name="checked" value="constant" class="form-control" 
                                                     <?php  echo 'checked="checked"';}?>
                                                    {{-- <input type="checkbox" name="checked" class="form-control" /> --}}
                                                    
                                            </td> 
                                            <td>  

                                                <?php $date1 = strtotime($public_holiday->date); if( (!$value &&  date('Y-m-d',$date1) > date('Y-m-d')) && ($public_holiday->type != 'constant') && (auth()->user()->status == 'active')){ ?>
                                                
                                                <a href= "/public_leave/{{$public_holiday->id}}/{{$public_holiday->name}}/{{$public_holiday->date}}"  class="btn btn-success update">
                                                Apply</a>
                                            
                                                 <?php }elseif(($public_holiday->type != 'constant') && date('Y-m-d',$date1) > date('Y-m-d') && auth()->user()->status == 'active'){ ?>
                                             
                                                <a href= "/cancel/{{Auth::id()}}/{{$public_holiday->id}}"  class="btn btn-danger alert_on_delete"> 
                                                    Cancel</a>
                                           
                                                <?php } elseif($public_holiday->type == 'constant'){Print_r("Holiday"); ?>
                                                <?php } elseif(auth()->user()->status == 'notice_period'){} ?>
                                            </td>
                                        </tr>   
                               @endforeach
                            </tbody>
                        </table>
                    </div>                
            </div>         
        </div>    
    </div>
@endsection


{{-- {{route('delete.public_leave')}} --}}