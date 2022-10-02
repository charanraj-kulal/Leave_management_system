@extends('layouts.app')
   
   @section('content')
   <!DOCTYPE html>
<html>
<head>
  <title>Manage public leave - Isarva Infotech Pvt Ltd</title>
</head>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Manage Public Holiday
                        </h3>
                        <div class="card-tools">
                            <button class="btn btn-block btn-info">
                              <a href={{ route('add.publicleave') }} class="text-white">Add New</a>
                            </button>
                        </div>
                    
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-head-fixed text-nowrap sortable">
                        <thead>
                            <tr>

                                <span style="color:red"></span>
                                <th>Action</th>                              
                                <th>Holiday</th>
                                <th>Date</th>
                                                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->sortBy('date') as $item)
                        <tr>
                            
                            <td>
                                <a href={{"edit/".$item['id']}} class="p-2 text-success"><i class="btn btn-info">Edit</i></a>
                                <a href={{"delete/".$item['id']}} class="p-2 text-danger alert_on_delete"><i class="btn btn-info">Delete</i></a>
                            </td>
                            <input  type="hidden" class="delete_val_id" value="{{ $item['id'] }}">
                            
                          	<td>{{$item['name']}}</td>
                            <?php $date=strtotime($item->date); $date1 = date("d/m/Y - l",$date); ?>
                            <td>{{$date1}}                               
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

