@extends('layouts.app')
   
@section('content')
   <!DOCTYPE html>
<html>
<head>
  <title>Manage leave type - Isarva Infotech Pvt Ltd</title>
</head>

   <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Manage Leave Type
                        </h3>
                    
                        <div class="card-tools">
                            <button class="btn btn-block btn-info">
                              <a href={{ route('add.leavetype') }} class="text-white">Add New</a>
                            </button>
                        </div>
                    </div>
       
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>

                                <span style="color:red"></span>
                                <th>Action</th>
                                <th>ID</th>
                                <th>Leave Type</th>
                                <th>Number Of Days</th>
                                                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                        <tr>
                            <td>
                                <a href={{"edit/".$item['id']}} class="p-2 text-success"><i class="btn btn-info">Edit</i></a>
                                <a href={{"delete/".$item['id']}} class="p-2 text-danger alert_on_delete_leave_type"><i class="btn btn-info">Delete</i></a>
                            </td>
                            <input  type="hidden" class="delete_val_id" value="{{ $item['id'] }}">
                            <td>{{$item['id']}}<small class="badge badge-warning ml-2"></td>
                            <td>{{$item['type']}}<small class="badge badge-warning ml-2"></td>
                            <td>{{$item['days']}}<small >                                    
                            </td>                                                      
                        </tr>    
                        @endforeach
                        </tbody>
                      </table>
                      <div class="card-footer clearfix">
                        <span class="table-pagination">                     
                        </span>
                      </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>    
    </div>
@endsection
