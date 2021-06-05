$(document).ready(function(){
    load_image_data();
    function load_image_data()
    {
     $.ajax({
      url:"Action/fetch.php",
      method:"POST",
      success:function(data)
      {
       $('#image_table').html(data);
      }
     });
    }

    // Delete 
    $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        var image_name = $(this).data("image_name");
        if(confirm("Are you sure you want to remove it?"))
        {
         $.ajax({
          url:"Action/delete.php",
          method:"POST",
          data:{id:id, image_name:image_name},
          success:function(data)
          {
           load_image_data();
           swal("Done!","It was succesfully deleted!","success");
          },
          error: function () {
              swal("Error deleting!", "Please try again", "error");
          }
           
         });
        }
       }); 
});    