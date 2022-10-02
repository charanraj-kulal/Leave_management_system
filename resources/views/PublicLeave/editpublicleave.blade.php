@extends('layouts.app')
   
@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Edit public leave - Isarva Infotech Pvt Ltd</title>
</head>

 <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Leave Type</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('edit.publicleave',['id' => $publicleave['id']])}}" method="POST">
               @csrf  
               <input type="hidden" name="id" value="{{$publicleave['id']}}">
               <div class="card-body">
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Leave Type <span class="asetkey">*</span></label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" id="type" class="form-control @error('type') is-invalid @enderror" pattern="[a-zA-Z'-'\s]*" name="name" placeholder="name" value="{{$publicleave['name']}}">
                      <span style="color:red">@error('name'){{$message}}@enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Date <span class="asetkey">*</span></label>
                    <div class="col-sm-10">
                      <input type="date"  class="form-control" name="date" value="{{$publicleave['date']}}" placeholder="Leave days">
                      <span style="color:red">@error('date'){{$message}}@enderror</span>
                    </div>
                  </div>
                    
                  
                  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Type of public leave<span class="asetkey">*</span></label>
                    <div class="col-sm-10">                     
                      <select class="form-control" name="type">
                        <option value="constant" <?php if($publicleave['type']=='constant') { ?> selected="selected" <?php } ?>>Fixed public leave</option>                         
                        <option value="flexy" <?php if($publicleave['type']=='flexy') { ?> selected="selected" <?php } ?>>Flexible public leave</option>                        
                      </select>
                      <span style="color:red">@error('type'){{$message}}@enderror</span>
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
    @endsection