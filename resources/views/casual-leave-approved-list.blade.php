@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Approved Casual Leave Applications - LMS</title>
</head>

<div class="content-wrapper" style="background-color: #ffff; !important;">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
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

                    <h3 class="card-title"><strong>Approved Casual Leave Applications</strong></h3>                    

                </div>
                <div class="card-body">
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
                            @forelse ($data as $index => $application)
                        <!-- Preview Leave application -->
                            <tr>
                                <td>{{$index+1}}</td><!-- For auto increment -->
                                <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->applier_user_name}}</a></td>
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
