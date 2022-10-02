@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Leave on Tomorrow - LMS</title>
</head>

<div class="content-wrapper" style="background-color: #ffff; !important;">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>Casual Leave </strong></h3>                    
                </div>
                
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Start date</th> 
                                    <th>End date</th> 
                                    <th>Number of days</th>
                                    <th>Reason</th>    
                                    <th>Approved By</th>
                                    <th>Approved On</th>                               
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data1 as $index => $application)
                                <!-- Preview Leave application -->
                               
                                    <tr><?php 
                                            $date1 = strtotime($application->start_date);
                                            $s_date = date('d-M-Y l', $date1); 
                                            $date2 = strtotime($application->end_date); 
                                            $e_date = date('d-M-Y l', $date2);
                                            $now_date = date('d-m-Y');
                                            $now_date = strtotime($now_date);
                                            $now_date = strtotime("+30 day", $now_date);
                                            $today_date = date('d-m-Y');
                                        
                                            $today_date = strtotime($today_date);
                                     
                                        if (($date1 <= $now_date)||($date2 = $now_date1)) { ?></p>
                                        
                                            <td>{{$index+1}}</td><!-- For auto increment -->
                                            <td>{{ $application->applier_name->name }}</td>
                                            <td>{{ $s_date }}</td>
                                            <td>{{ $e_date }}</td>
                                            <td>{{$application->number_of_days}}
                                            <td>{{ $application->reason }}</td>
                                            <?php if ($application->authorizer_user_id == 10){ ?>
                                                <td> Deep kiran </td>
                                                <?php } elseif($application->authorizer_user_id  == 4) { ?>
                                                    <td>Idaksh.6</td>
                                                    <?php } ?>
        
                                            <?php $up_date = strtotime($application->updated_at); $updated_at_date = date('d-m-Y',$up_date); ?>
                                            <?php if ($application->status == 'approved') { ?>
                                                <td>{{$updated_at_date}}</td>
                                                <?php } else{ ?> 
                                                    <td> </td>
                                                    <?php } ?>
                                            
                                           
                                        <?php }else{} ?>
                                         
                                    </tr> 
                                    @empty
                                    
                                        <tr> No details found  </tr> 

                                        
                                                     
                                @endforelse
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>Public Leave </strong></h3>                    
                </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Date</th> 
                                    <th>Holiday</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data2 as $index => $application)
                                <!-- Preview Leave application -->
                               
                                    <tr><?php $date1 = strtotime($application->public_leave_date);
                                     $date = date('d-M-Y l', $date1);  
                                     $now_date = date('d-m-Y');
                                     $now_date = strtotime($now_date);
                                        $now_date = strtotime("+30 day", $now_date);
                                        $today_date = date('d-m-Y');
                                        // print_r($application->public_leave_date);exit;
                                        $today_date = strtotime($today_date);
                                     //print_r($date1);exit;
                                    
                                        if ($date1 <= $now_date){ ?></p>
                                        
                                            <td>{{$index+1}}</td><!-- For auto increment -->
                                            <td>{{ $application->applier_name->name }}</td>
                                            
                                            <td>{{ $date }}</td>
                                            <td>{{ $application->public_leave_name }}</td>
                                            
                                           
                                        <?php }else{} ?>
                                         
                                    </tr> 
                                    @empty
                                    
                                        <tr> No posts found  </tr> 

                                        
                                                     
                                @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
        </div>


</div>
    <div class="card-footer clearfix"style="background-color: #ffff; !important;">
        <span class="table-pagination">
        {{$data2->links()}}
        </span>
</div>    

</div> 
<?php } else{ ?>    
    <div class="content-wrapper" style="background-color: #ffff; !important;">
    <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>
    </div>
<?php } ?>
    @endsection
