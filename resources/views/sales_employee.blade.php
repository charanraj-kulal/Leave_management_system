@extends('layouts.app')



@section('content')<!-- for displaying Leave count status-->

<!DOCTYPE html>

<html>

<head>

  <title>Dashboard - LMS</title>

</head>

<div class="content-wrapper">   
 
	<marquee><a style = "color:red; font-weight: bold;" href="">Read Leave Policy.</a></marquee>

        <div class="col-md-12">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title"><strong>Available Leaves</strong></h3>

                </div>

            

                <div class="card-body">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>Type</th>

                                <th>Allowance Per Year (days)</th>

                                <th>Used (days)</th>

                                <th>Remaining (days)</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($types as  $type)

                                <tr data-widget="expandable-table" aria-expanded="false">

                                    <td>{{ $type->type }}</td>

                                    <td>{{ $type->days }}</td>

                                    <td>{{ $leaveCount[$type->type] }}</td>

                                    <td>{{ $type->days - $leaveCount[$type->type] }}</td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="4">No Data</td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    



<!--My Leave applications -->



    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title"><strong>My Casual Leave Applications</strong></h3>                

            </div>

                    <div class="card-body p-0">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>Sl No</th>

                                <th>Date</th>

                                <th>Reason</th>

                                <th>Duration</th>

                                <th>Status</th>

                                <th>Action</th> 

                                <th>By</th>

                                <th>On</th>                             

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($myApplications as $index => $application)

                                <tr>

                                    <td>{{$index+1}}</td>

                                    <td><a href="#" id="btn{{$application->id}}" data-toggle="modal" data-target="#modal{{$application->id}}">{{ $application->start_date }}@if ($application->end_date)

                                        - {{ $application->end_date }} 

                                        @endif</a></td> 

                                    <td>{{$application->reason}}</td>

                                    <?php if($application->number_of_days == 0.5){ ?>

                                        <td>Half Day</td>

                                        <?php } else {   ?>

                                    <td>{{ $application->number_of_days }}</td>

                                    <?php } ?>

                                    <td>@if ($application->status == 'approved')

                                        <span class="badge badge-pill badge-success">{{ $application->status }}</span>                                        

                                        @elseif($application->status == 'rejected')

                                        <span class="badge badge-pill badge-danger">{{ $application->status }}</span>

                                        @else

                                        <span class="badge badge-pill badge-dark">{{ $application->status }}</span>

                                        @endif

                                    </td> 

                                    <td> <!-- To give cancel button based on date -->

                                        

                                        <?php $date1 = strtotime($application->start_date); if(date('Y-m-d',$date1) > date('Y-m-d')){ ?>

                                        <a href={{"delete/".$application['id']}}  class="btn btn-block btn-danger alert_on_delete" style="width: 10rem;">Cancel application</a> 

                                        <?php } else { ?>

                                        You are unable to delete

                                        <?php }  ?> 

                                    </td>

                                     <!-- To give approved or rejected by name -->

                                     <?php if ($application->authorizer_user_id == 1){ ?>

                                        <td> Deep kiran </td>

                                        <?php } elseif($application->authorizer_user_id  == 5) { ?>

                                            <td>Idaksh.6</td>

                                            <?php } ?>



                                            <!-- To give approved or rejected date -->

                                    <?php $up_date = strtotime($application->updated_at); $updated_at_date = date('d-m-Y',$up_date); ?>

                                    <?php if ($application->status == 'approved' || $application->status == 'rejected') { ?>

                                        <td>{{$updated_at_date}}</td>

                                        <?php } else{ ?> 

                                            <td> </td>

                                            <?php } ?> 



                                                



                                </tr> 



                    <!--My Leave applications -->                                

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

                                            <div class="col-3 text-right">Period</div>

                                            <div class="col-9">{{ $application->start_date }} @if ($application->end_date)

                                                - {{ $application->end_date }} @endif

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-3 text-right">Duration</div>

                                            <div class="col-9">

                                                {{ $application->number_of_days }} day(s)

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-3 text-right">Type</div>

                                            <div class="col-9">

                                                {{ $application->type }}

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-3 text-right">Status</div>

                                            <div class="col-9">

                                                {{ $application->status }}

                                            </div>

                                        </div>

                                        {{-- @if ($application->status == 'rejected' || $application->status == 'approved' )

                                        <div class="row">

                                            <div class="col-3 text-right">Remarks</div>

                                            <div class="col-9">

                                                {{ $application->remarks }}

                                            </div>

                                        </div>

                                        @endif --}}

                                        <div class="row">

                                            <div class="col-3 text-right">Reason</div>

                                            <div class="col-9">

                                                {{ $application->reason }}



                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>

                                </div>

                                </div>

                                @empty <!-- for empty application -->

                                

                            </div>                          

                            @endforelse                            

                        </tbody>

                    </table>

                </div>

            </div>

        </div>         

    </div>    



</div>

@endsection