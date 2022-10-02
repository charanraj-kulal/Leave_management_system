//js for alert on Rejecting the application
$('.alert_on_reject').click(function(e){
  var result = confirm("Your rejecting the application");
  if(result == true){
    
  }else{
  return false;
  }
});



//js for alert on Deleting the casual leave application

$('.alert_on_delete').click(function(e){
  var result = confirm("Are you sure. You want to delete your application");
  if(result == true){
    
  }else{
  return false;
  }
});


//js for Check box and radio button on Casual leave application
$(document).ready(function(){
  $("input[name='halfday']").on("change", function(){
      var isChecked = $(this).prop("checked"); 
      if(isChecked){
          $(".buttons").show(); 
      } else {
          $(".buttons").hide(); 
          $("input[name='halfday'][value='morning']").prop("checked", "checked"); 
      }
  }); 
}); 
