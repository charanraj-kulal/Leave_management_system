@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Pending Casual Leave Applications - LMS</title>
</head>

<div class="content-wrapper" style="background-color: #ffff; !important;">
 
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>Rejected Casual Leave Applications</strong></h3>
                </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Number days</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($applications as $index => $application)
                        <!-- Preview Leave application -->
                            <tr>
                                <td>{{$index+1}}</td><!-- For auto increment -->
                                <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->applier_user_name }}</a></td>
                                <td>{{ $application->start_date }}</td>
                                <td>{{ $application->end_date }}</td>
                                <?php if($application->number_of_days == 0.5){ ?>
                                    <td>{{ $application->half_day_session }}</td>
                                    <?php } else {   ?>
                                <td>{{ $application->number_of_days }}</td>
                                <?php } ?>
                                <td>{{ $application->reason }}</td>
                            </tr>          
                                                            
                                @empty
                                                      
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
   
    </div>
        <div class="card-footer clearfix"style="background-color: #ffff; !important;">
                        <span class="table-pagination">
                        {{$applications->links()}}
                        </span>
        </div>

</div> 
<?php } else{ ?>    
    <div class="content-wrapper" style="background-color: #ffff; !important;">

    <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>



    </div>
<?php } ?>
    @endsection
