@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Leave status of all employees - LMS</title>
</head>

<div class="content-wrapper" style="background-color: #ffff; !important;">
   
    
    <div class="row">
    
        <div class="col-md-6">
           
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">

                    <h3 class="card-title"><strong>All employee casual leave status</strong></h3>                    

                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead><?php// print_r(count($usersUnique)); ?>
                                <tr>
                                    
                                    <th>Employee</th>
                                    <th>Casual Leave taken</th>
                                    <th>Casual Leave available</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            @forelse ($usersUnique as $application)
                        <!-- Preview Leave application -->
                            <tr>
                               
                                <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->applier_user_name }}</a></td>
                                <?php $value = \App\Models\LeaveApplication::get_number_of_days($application->applier_user_id); ?>
                                <?php// print_r($value); ?>
                                <td>{{ $value}}</td>
                                <td>{{ 20-$value }}</td>                                
                            </tr>          
                                                            
                                @empty
                                                      
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">

                    <h3 class="card-title"><strong>All employee public leave status</strong></h3>                    

                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead><?php// print_r(count($usersUnique)); ?>
                                <tr>
                                    
                                    <th>Employee</th>
                                    {{-- <th>Public Leave consumed</th> --}}
                                    <th>Public Leave taken</th>
                                    <th>Public Leave available</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            @forelse ($usersUnique2 as $application)
                        <!-- Preview Leave application -->
                            <tr>
                                
                                <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->applier_user_name }}</a></td>
                                <?php $value = \App\Models\PublicLeaveApplication::get_public_number_of_days($application->applier_user_id); ?>
                                <?php// print_r($value); ?>
                                <td>{{ $value}}</td>
                                <td>{{ 10-$value }}</td>                                
                            </tr>          
                                                            
                                @empty
                                                        
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
        <div class="card-footer clearfix"style="background-color: #ffff; !important;">
                        <span class="table-pagination">
                        {{-- {{$data->links()}} --}}
                        </span>
        </div>

</div> 
<?php } else{ ?>    
    <div class="content-wrapper" style="background-color: #ffff; !important;">
        <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>
    </div>
<?php } ?>
    @endsection