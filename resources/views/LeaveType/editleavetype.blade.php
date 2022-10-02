@extends('layouts.app')
   
@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Edit leave type - Isarva Infotech Pvt Ltd</title>
  <link rel="icon" type="image/png" href="{{ asset('dist/img/favicon.png') }} ">
</head>
 <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Leave Type</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
          <form class="form-horizontal" action="{{route('edit.leavetype',['id' => $leavetype['id']])}}" method="POST">
              @csrf  
              <input type="hidden" name="id" value="{{$leavetype['id']}}">
              <div class="card-body">
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Leave Type <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" name="type" id="type" class="form-control @error('type') is-invalid @enderror" pattern="[a-zA-Z]{1,}" placeholder="Leave Type" value="{{$leavetype['type']}}">
                    <span style="color:red">@error('type'){{$message}}@enderror</span>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Number of days <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="number"  class="form-control" name="days" value="{{$leavetype['days']}}" placeholder="Leave days">
                    <span style="color:red">@error('days'){{$message}}@enderror</span>
                  </div>
                </div>
              </div>            
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Submit</button>
              <!-- <button type="reset" class="btn btn-default">Reset</button> -->
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
    </div>
    @endsection

