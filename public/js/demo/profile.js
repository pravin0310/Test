$(document).ready(function(){


    load_profile_data();
    function load_profile_data()
    {
     $.ajax({
      url:"Action/fetch_profile.php",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
       
        // product name
        $('#id').val(data.id);
        $("#user_name").val(data.user_name);
        
        
      },
      error:function(data){
        swal("Error Update!", "Please try again", "error");
      }
     });
    }

    load_pass_data();
    function load_pass_data()
    {
     $.ajax({
      url:"Action/fetchpass.php",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
       
        // product name
        $('#passid').val(data.id);
        $("#curpass").val(data.password);
        
        
      },
      error:function(data){
        swal("Error Update!", "Please try again", "error");
      }
     });
    }

    // Delete 
    $('#formusersubmit').on("submit", function(event){  
        event.preventDefault();  
       
             $.ajax({  
                  url:"Action/updateuser.php",  
                  method:"POST",  
                  data:$('#formusersubmit').serialize(),  
                  beforeSend:function(){  
                    
                  },  
                  success:function(data){  

                    if(data ==1){
                        load_profile_data();  
                        swal("Done!","It was succesfully Updated!","success");
                      }
                    else{
                        
                        swal("Error Update!", "Please try again", "error");
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                       }, 3000);
                        
                    }
                }
                    
                
             });  
         
   });  
   $('#formpasssubmit').on("submit", function(event){  
    event.preventDefault();  
   
         $.ajax({  
              url:"Action/updatepass.php",  
              method:"POST",  
              data:$('#formpasssubmit').serialize(), 
              dataType: 'json', 
              beforeSend:function(){  
                
              },  
              success:function(data){
                  console.log(data);  
                load_pass_data(); 
                if(data.success ==true){
                    $("#formpasssubmit")[0].reset();
                    $('.changePasswordMessages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ data.messages +
              '</div>');
                  
                    $(".alert-success").delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    }); // /.alert	  
                }else{
                    $("#formpasssubmit")[0].reset();
                    $('.changePasswordMessages').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ data.messages +
              '</div>'); 
              $('#formpasssubmit').reset();
              $(".alert-warning").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                    $(this).remove();
                });
            }); // /.alert	 
                }
                
            }
                
            
         });  
     
});  
});    