@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Public Leave Applied Status - LMS</title>
</head>

<div class="content-wrapper" style="background-color: #ffff; !important;">
    <div class="col-md-12">
        <div class="card card-primary card-outline mt-3">
            <div class="card-header search_panel">
                <h3 class="card-title">
                    <i class="fas fa-search"></i>
                        Search Panel
                </h3>
            </div>
            <div class="card-body">
            <form action="" class="mt-3">
                <div class="mb-3 form-group">
                    <div class="row">
                        <div class="col-6">
                            <input type="date" name="search" class="form-control" placeholder="Search by date"  aria-describedby="basic-addon2">
                        </div>
                        
                        <div class="col-2">
                            <button class="btn btn-info">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
        <div class="col-md-12">
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title"><strong>Public leave applied</strong></h3>                    
                </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Date</th> 
                                    <th>Holiday</th>                                   
                                    <th>Leave Type</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $index => $application)
                        <!-- Preview Leave application -->
                            <tr>
                                <td>{{$index+1}}</td><!-- For auto increment -->
                                <td>{{ $application->applier_user_name }}</td>
                                <?php $date1 = strtotime($application->public_leave_date); $date = date('M d, Y', $date1); ?></p>
                                <td>{{ $date }}</td>
                                <td>{{ $application->public_leave_name }}</td>
                                <?php if($application->leave_type_id==1) { ?>
                                <td>Casual Leave</td>
                                <?php } else{ ?>
                                    <td> Public Leave</td><?php } ?>
                                
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
        {{$data->links()}}
        </span>
</div>    

</div> 
<?php } else{ ?>    
    <div class="content-wrapper" style="background-color: #ffff; !important;">
    <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>
    </div>
<?php } ?>
    @endsection
