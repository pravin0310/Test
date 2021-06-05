$("#mobile").keydown(function(event) {
    k = event.which;
    if ((k >= 96 && k <= 105) || k == 8) {
      if ($(this).val().length == 10) {
        if (k == 8) {
          return true;
        } else {
          event.preventDefault();
          return false;
  
        }
      }
    } else {
      event.preventDefault();
      return false;
    }
  
  });

  function check()
  {
  
      var mobile = document.getElementById('mobile');
     
      
      var message = document.getElementById('messages_alert');
  
      var goodColor = "#0C6";
      var badColor = "#FF9B37";
    
      if(mobile.value.length!=10){
         
          mobile.style.borderColor =badColor;
          message.style.color = badColor;
          message.innerHTML = "required 10 digits, match requested format!"
      }else{

          mobile.style.borderColor = goodColor;
          message.style.color = goodColor;
          message.innerHTML = "Good!"
      }
  }
$('#enquiry_get').on("submit", function(event){  
    event.preventDefault();
       
         $.ajax({  
              url:"admin/Action/enquiry.php",  
              method:"POST",  
              data:$('#enquiry_get').serialize(), 
              dataType: 'json', 
              beforeSend:function(){  
                
              },  
              success:function(data){
                  
                
                if(data.success == 1){
                    $("#enquiry_get")[0].reset();
                    $('.messageenquiry').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ data.messages +
              '</div>');
                  
                    $(".alert-success").delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    }); // /.alert	  
                }else{
                    $("#enquiry_get")[0].reset();
                    $('.messageenquiry').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ data.messages +
              '</div>'); 
              $('#enquiry_get').reset();
              $(".alert-warning").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                    $(this).remove();
                });
            }); // /.alert	 
                }
                
            }
                
            
         });  
     
});