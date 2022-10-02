@extends('layouts.app')



@section('content')

<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>

<!DOCTYPE html>

<html>

<head>

  <title>Pending Casual Leave Applications -LMS</title>
  <link rel="icon" type="image/png" href="{{ asset('dist/img/LMS logo small.png') }}">

</head>



<div class="content-wrapper" style="background-color: #ffff; !important;">

    <div class="row">

        <div class="col-12">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title"><strong>Pending Casual Leave Applications</strong></h3>                    

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

                                <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->applier_name }}</a></td>
				
				                <?php $date1 = strtotime($application->start_date) ; $s_date = date('M d, Y l',$date1); ?>

                                <td>{{ $s_date }}</td>

				                <?php $date2 = strtotime($application->end_date) ; $e_date = date('M d, Y l',$date2); ?>

                                <td>{{ $e_date }}</td>

                                <?php if($application->number_of_days == 0.5){ ?>

                                    <td>{{ $application->half_day_session }}</td>

                                    <?php } else {   ?>

                                <td>{{ $application->number_of_days }}</td>

                                <?php } ?>

                                <td>{{ $application->reason }}</td>

                            </tr>

                        

                        <!-- Action view Leave application -->

                                <div class="modal fade" id="modal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="CenterTitle"

                                    aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="LongTitle">Application Details</h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                    <span aria-hidden="true">&times;</span>

                                                </button>

                                            </div>



                                            <div class="modal-body py-0">

                                                

                                                <div class="row">

                                                    <div class="col-3 text-right">Applier</div>

                                                    <div class="col-9">{{ $application->applier_name }}</div> <!--display the applier name-->

                                                </div>

                                                <div class="row">

                                                    <div class="col-3 text-right">Period</div><!--display the period start and end date-->

                                                    <div class="col-9">

                                                        {{ $application->start_date }} 

                                                        @if ($application->end_date)

                                                        - {{ $application->end_date }} 

                                                        @endif

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-3 text-right">Duration</div><!--display the duration in days if it is half day then session-->

                                                    <div class="col-9">

                                                        <?php if($application->number_of_days == 0.5){ ?>

                                                            {{ $application->half_day_session }} session

                                                            <?php } else {   ?>

                                                        {{ $application->number_of_days }} days

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-3 text-right">Type</div><!--display the Leave Type-->

                                                    <div class="col-9">

                                                        {{ $application->leave_type }}

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-3 text-right">Reason</div><!--display the Reason-->

                                                    <div class="col-9">                                                                            

                                                        {{ $application->reason }}

                                                    </div>

                                                </div>

                                                <form method="POST" action="{{ Route('update', [$application->id]) }}"><!--For approve or reject the application it will go to LeaveApplicationController update function-->

                                                    @csrf



                                                    <input  type="hidden" class="delete_val_id" value="{{ $application->id }}">

                                                    <button type="submit" class="btn btn-primary float-right ml-2" name="approved">Approve</button>

                                                    <button type="submit" class="btn btn-danger float-right alert_on_reject" name="rejected">Reject</button><br><br>

                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><br><br> --}}

                                                </form>

                                            </div>



                                            {{-- <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div> --}}

                                        </div>

                                    </div>

                                </div>

                                                            

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

