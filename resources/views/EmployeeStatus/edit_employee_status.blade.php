@extends('layouts.app')
   
@section('content')
<?php if(auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 2 ) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit employee status - LMS</title>
</head>

 <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Employee Status</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('edit.employee',['id' => $employee_details['id']])}}" method="POST">
               @csrf  
               <input type="hidden" name="id" value="{{$employee_details['id']}}">
               
               <div class="card-body">
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Employee name <span class="asetkey">*</span></label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" name="name" readonly="ture" placeholder="name" value="{{$employee_details['name']}}">
                      <span style="color:red">@error('name'){{$message}}@enderror</span>
                    </div>
                    <?php //exit; ?>
                  </div>
                  
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Email <span class="asetkey">*</span></label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" name="email" readonly="ture" value="{{$employee_details['email']}}" placeholder="Email">
                      <span style="color:red">@error('email'){{$message}}@enderror</span>
                    </div>
                  </div>
                    
                  
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Status<span class="asetkey">*</span></label>
                    <div class="col-sm-10">                     
                      <select class="form-control" name="status">
                        <option value="active" <?php if($employee_details['status']=='active') { ?> selected="selected" <?php } ?>>Active</option>                         
                        <option value="notice_period" <?php if($employee_details['status']=='notice_period') { ?> selected="selected" <?php } ?>>Under notice period</option>
                        <option value="blocked" <?php if($employee_details['status']=='blocked') { ?> selected="selected" <?php } ?>>Blocked</option>                        
                      </select>
                      <span style="color:red">@error('days'){{$message}}@enderror</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">User group<span class="asetkey">*</span></label>
                    <div class="col-sm-10">                     
                      <select class="form-control" name="user_group_id">
                        <option value="1" <?php if($employee_details['user_group_id']=='1') { ?> selected="selected" <?php } ?>>Admin</option>                         
                        <option value="2" <?php if($employee_details['user_group_id']=='2') { ?> selected="selected" <?php } ?>>Manager</option>
                        <option value="4" <?php if($employee_details['user_group_id']=='4') { ?> selected="selected" <?php } ?>>Employee</option>
                                              
                      </select>
                      <span style="color:red">@error('days'){{$message}}@enderror</span>
                    </div>
                  </div>
              
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <!-- <button type="reset" class="btn btn-default">Reset</button> -->
                  </div>
                  <!-- /.card-footer -->
               </div>
            </form>
        </div>
    </div>
    <?php } else{ ?>    
      <div class="content-wrapper" style="background-color: #ffff; !important;">
          <h3 class="card-title"><strong>You are not authorized to enter here</strong></h3>
      </div>
    <?php } ?>
    @endsection