@extends('layouts.app')

@section('content')<!-- for displaying Leave count status-->
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - LMS</title>
</head>
<div class="content-wrapper">    
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><strong>Leaves exceeded members</strong></h3>
                </div>
            
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Used (days)</th>
                                <th>Remaining (days)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($types->days - $leaveCount[$types->type] < 0){ ?>
                            @forelse ($types as  $type)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ 1 }}</td>
                                    <td>{{ $type->days }}</td>
                                    <td>{{ $leaveCount[$type->type] }}</td>
                                    <td>{{ $type->days - $leaveCount[$type->type] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                            @endforelse
                            <?php } else {echo("No data available");} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    



</div>
@endsection