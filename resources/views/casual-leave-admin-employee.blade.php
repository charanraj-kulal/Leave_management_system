@extends('layouts.app') <!-- Casual leae application-->

   
@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Apply for casual leave for employee - LMS</title>
</head>

 <div class="content-wrapper" style="background-color: #ffff !important;">
    <div  class="container-fluid pt-2" >
        <div class="card card-primary" >
            <div  class="card-header" >

            <h3 class="card-title">Apply For Cassual Leave by admin for employee</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=""> <!-- this will be the route for submit action-->
                    @csrf
        
                    <div class="form-group">
                        <label>From date:</label>
                        <div class='input-group date' id='start_date'>
                            <input type='date' name='start_date' id='start_date' class="form-control @error('start_date') is-invalid @enderror" min="<?php echo date("Y-m-d"); ?>"/>
                           
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label>To date:</label>
                        <div class='input-group date' >
                            <input type='date' name='end_date' id='end_date' class="form-control @error('end_date') is-invalid @enderror" min="start_date" />
                            
                        </div>
                    </div>  
                    <br> 
                    <div class="form-group row">
                        <label for="Select_employe" class="col-sm-2 col-form-label">Category  <span class="asetkey">*</span></label>
                        <div class="col-sm-10">
                        <select class="form-control select2 required" name="employee_id[]" id="employee_id" multiple="multiple">
                                                        
                        @foreach ($data as $key=>$emp)
                                  <option value="{{ $key }}">{{ $emp }}</option>
                                @endforeach
                          </select>
                          @error('category_id')
                          <span class="text-danger select-require">{{ $message }}</span>
                          @enderror
                          
                        </div>
                      </div>
                <br>  

    
                    <div class="form-group">
                        <label>Reason:</label>                        
                        <input type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" placeholder="i.e. Due to sickness" value="{{ old('reason') }}">
                        
                    </div>
                    <br>

                    <div class="form-check">
                        <div class="col-md-12" style="display: flex; gap: 1rem;">
                            <input type="checkbox" class="form-check-input" id="halfday" name="halfday" value="1" >
                            <label for="halfday">Is it a half day ?</label>
                            <div class="buttons">                               
                                    <input type="radio" class="form-radio-input" id="Morning" name="half_day_session" value="Morning" checked="checked">
                                    <label for="Morning">Morning</label>
                                    <input style="margin-left: 1rem;" type="radio" class="form-radio-input" id="Afternoon" name="half_day_session" value="Afternoon">
                                    <label for="Afternoon">Afternoon</label>     
                                                             
                            </div>                              
                        </div>  
                    </div> 
                    <br>
 
                    <div class="form-group"> 
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


    
    