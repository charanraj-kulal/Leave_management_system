@extends('layouts.app') <!-- Casual leae application-->

   
@section('content')

<!DOCTYPE html>
<html>
<head>
  <title>Apply for casual leave - LMS</title>
</head>

 <div class="content-wrapper" style="background-color: #ffff !important;">
        <?php if(auth()->user()->status == 'notice_period' ) { ?>
           <div class="col-md-12" >
             <h3 style = "color:red" >  You are in notice period!. You are not allowed to apply for any Casual leaves. </h3>
           </div>
        <?php } else { ?>
    <div  class="container-fluid pt-2" >
        <div class="card card-primary" >
            <div  class="card-header" >

                <h3 class="card-title">Apply For Casual Leave</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ Route('store') }}"> <!-- this will be the route for submit action-->
                    @csrf
        
                    <div class="form-group">
                        <label>From date:</label> 
                        <div class='input-group date' id='start_date'><!-- from date and previous dates are dissabled -->
                            <input type='date' name='start_date' id='start_date' class=" form-control 
                             @error('start_date') is-invalid @enderror" min="<?php echo date("Y-m-d"); ?>"/>
                            
                        </div>
                        
                        @if ($errors->has('start_date')) <!-- validation error message -->
                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                        @endif
                    </div>
                    <br>

                    <div class="form-group">
                        <label>To date:</label>
                        <div class='input-group date' ><!-- end date-->
                            <input type='date' name='end_date' id='end_date' class="form-control 
                            @error('end_date') is-invalid @enderror" min="<?php echo date("Y-m-d"); ?>" >
                            
                        </div>
                        @if ($errors->has('end_date')) <!-- validation error message -->
                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>  
                    <br>   

    
                    <div class="form-group">
                        <label>Reason:</label>    <!-- Reason-->                    
                        <input type="text" class="form-control @error('reason') is-invalid @enderror" pattern="[a-zA-Z'-'\s]*"  name="reason" id="reason" placeholder="i.e. Due to sickness" value="{{ old('reason') }}">
                        @if ($errors->has('reason')) <!-- validation error message -->
                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                    @endif
                    </div>
                    <br>
                    <div><h6><strong>If you select half day then end date will same as start date</strong><h6></div>
                        <br>

                    <div class="form-check">
                        <div class="col-md-12" style="display: flex; gap: 1rem;">
                            
                            <input type="checkbox" class="form-check-input" id="halfday" name="halfday" value="1" >
                            <label for="halfday">Is it a half day ?</label> <!-- for checkbox custome js is written for if checkbox enabled then radio button will enable-->
                            
                            <div class="buttons">                               
                                    <input type="radio" class="form-radio-input" id="Morning" name="half_day_session" value="Morning" checked="checked">
                                    <label for="Morning">Morning</label>
                                    <input style="margin-left: 1rem;" type="radio" class="form-radio-input" id="Afternoon" name="half_day_session" value="Afternoon">
                                    <label for="Afternoon">Afternoon</label>     
                                                             
                            </div>                              
                        </div>  
                    </div> 
                    <br>
 
                    <div class="form-group">  <!-- submit the form-->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

@endsection


    
    