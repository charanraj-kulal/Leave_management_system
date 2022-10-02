@extends('layouts.app')

@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>

    <!DOCTYPE html>
    <html>
        <head>
        <title>Employee status - LMS</title>
        </head>
 <div class="content-wrapper mt-3 ">
   
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>All employee status</strong></h3>                
                </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    
                                    <th>Sl No</th>
                                    <th>Employee Name</th>                                
                                    <th>Status</th>
                                    <th>User Group </th>   
                                    <th>Action </th>                           
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($employee_status ->sortBy('id') as $index => $e_s)
                            
                                    <tr>                                       
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $e_s->name }}</td>
                                        <?php if($e_s->status == 'active') { ?>                                      
                                            <td>Active</td>
                                        <?php } elseif($e_s->status == 'notice_period') { ?> 
                                            <td>Under notice period</td>
                                        <?php } elseif($e_s->status == 'blocked') { ?>
                                            <td>Blocked</td>
                                        <?php } ?>

                                        <?php if($e_s->user_group_id == '1') { ?> 
                                            <td>Admin</td> 
                                        <?php } elseif($e_s->user_group_id == '2') { ?> 
                                            <td>Manager</td>
                                        <?php } elseif($e_s->user_group_id == '4') { ?>
                                            <td>Employee</td>
                                        <?php } elseif($e_s->user_group_id == '5') { ?>
                                            <td>Sales Employee</td>
                                        <?php } ?>


                                        <td>
                                            <a href={{"edit/".$e_s['id']}} class="p-2 text-success"><i class="btn btn-info">Edit</i></a>
                                            
                                        </td>

                                          
                                          
                                        </tr>   
                               @endforeach
                            </tbody>
                        </table>
                    </div>                
            </div>         
        </div>    
    </div>
    <?php } else{ ?>    
        <div class="content-wrapper" style="background-color: #ffff; !important;">
            <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>
        </div>
    <?php } ?>
@endsection


{{-- {{route('delete.public_leave')}} --}}