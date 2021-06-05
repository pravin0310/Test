$(document).ready(function(){
    load_text_data();
    function load_text_data()
    {
     $.ajax({
      url:"Action/fetch_settings.php",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
        // $('#formsubmit').val(data);
        // product name
        $('#id').val(data.id);
        $("#name").val(data.Name);
        $("#email").val(data.Email);
        $("#address").val(data.Address);
        $("#mobile").val(data.phone_number);
        $("#title").val(data.Title_front);
        $("#header").val(data.Title_front_1);
        // $('#insert').val("Update");  
        
      },
      error:function(data){
          console.log(data);
      }
     });
    }

    // Delete 
    $('#formsubmit').on("submit", function(event){  
        event.preventDefault();  
       
             $.ajax({  
                  url:"Action/updatesettings.php",  
                  method:"POST",  
                  data:$('#formsubmit').serialize(),  
                  beforeSend:function(){  
                    
                  },  
                  success:function(data){  
                    load_text_data();  
                    swal("Done!","It was succesfully Updated!","success");
                  },
                  error: function () {
                    swal("Error Update!", "Please try again", "error");
                }
             });  
         
   });  
});    