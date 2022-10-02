@extends('layouts.app')
   
@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Leave type for sales - Isarva Infotech Pvt Ltd</title>
</head>

 <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Leave Type for Sales Group</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
       
            <form class="form-horizontal" action="add" method="POST">
               @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Leave type <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" name="type" value="{{old('type')}}" placeholder="Leave type">
                    <span style="color:red">@error('type'){{$message}}@enderror</span>
                  </div>
                </div>

                
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Number of days <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="number"  class="form-control" name="days" value="{{old('days')}}" placeholder="Leave days">
                    <span style="color:red">@error('days'){{$message}}@enderror</span>
                  </div>
                </div>
            
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>                
              </div>
              <!-- /.card-footer -->
            </div>
            </form>
        </div>
    </div>
@endsection