@extends('layouts.app')
   
@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Add public leave - Isarva Infotech Pvt Ltd</title>
</head>
 <div class="content-wrapper">
      <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Public Holiday</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
       
            <form class="form-horizontal" action="add" method="POST">
               @csrf  
              <div class="card-body">
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Holiday Name <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" id="type" class="form-control @error('type') is-invalid @enderror" pattern="[a-zA-Z'-'\s]*" name="name" value="{{old('name')}}" placeholder="Holiday Name">
                    <span style="color:red">@error('name'){{$message}}@enderror</span>
                  </div>
                </div>

                
                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Date <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <input type="date"  class="form-control" name="date" value="{{old('date')}}" placeholder="Date">
                    <span style="color:red">@error('date'){{$message}}@enderror</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="category_name" class="col-sm-2 col-form-label">Type of public leave <span class="asetkey">*</span></label>
                  <div class="col-sm-10">
                    <select class="form-control" name="type">
                      <option value="constant">Fixed public leave</option>
                      <option value="flexy">Flexible public leave</option>
                    </select>
                    <span style="color:red">@error('type'){{$message}}@enderror</span>
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
