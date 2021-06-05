@extends('layouts.admin')
        <!-- End of Sidebar -->
@section('content')

        <!-- Content Wrapper -->
        <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    @if(Auth::user()->id =='1')
        <button type="submit" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Add User</button>
    @else
        <button type="submit" data-toggle="modal" data-target="#exampleModal3" class="btn btn-warning">Import</button>
        <button type="submit" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary">Add Employee</button>
    @endif
</div>


<div class="text-center">
      
        <span id="success" class="text-success"></span>
        <span id="wanings" class="text-danger"></span>
</div>
<div class="container-fluid">
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
@endif
@if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
@endif
     @if(Auth::user()->id =='1')
        <table class="table table-bordered" id="example2" >
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>

                <tbody>
                
                </tbody>
            
        </table>
     @else
        <table class="table table-bordered" id="example1" >
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee  Name</th>
                        <th>Department</th>
                        <th>Age</th>
                        <th>Experience in the Organization</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>

                <tbody>
                
                </tbody>
            
        </table>

     @endif  

</div>



<!-- Content Row -->


    
<!-- model content in User add form -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">

        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <h5 class="modal-title" id="exampleModalLabel1">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="modal-body">

                        <form id="Userinsertss" method="post">
                            @csrf 
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="productname">User Name</label>
                                <input type="text" class="form-control" name="user_name" placeholder="Enter User Name">
                            </div>
                            <div class="form-group">
                                <label for="productname">Email</label>
                                <input type="email" class="form-control" name="email"  placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="productname">Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Enter Password">
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Userinsert">Save changes</button>
                    </div>
                </div>
        </div>
</div>
<!-- model content in User add form End -->



<!-- model content in User add form -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">

        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <h5 class="modal-title" id="exampleModalLabel2">Employee Import</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('employee.import') }}" method="post" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label for="productname">Import CSV</label>
                                <input type="file" class="form-control" name="importfile" placeholder="Enter User Name">
                            </div>
                       
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                    </form>
                </div>
        </div>
</div>
<!-- model content in User add form End -->


<!-- model content in Employee add form -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">

        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <h5 class="modal-title" id="exampleModalLabel3">Employee Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger print-error-msg1" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="modal-body">

                        <form id="employeeinsertss" method="post">
                            @csrf 
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <input type="text" value="{{ Auth::user()->id }}" name="userid" hidden>
                                <label for="productname">Employee Code</label>
                                <input type="text" class="form-control" id="employee_code" name="employee_code">
                            </div>
                            <div class="form-group">
                                <label for="productname">Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" placeholder="Enter Employee Name">
                            </div>
                            <div class="form-group">
                                <label for="productname">Department</label>
                                <input type="text" class="form-control" name="employee_department"  placeholder="Enter Employee Department">
                            </div>
                            <div class="form-group">
                                <label for="productname">Age</label>
                                <input type="text" class="form-control" name="employee_age"  placeholder="Enter Employee Age">
                            </div>
                            <div class="form-group">
                                <label for="productname">Experience</label>
                                <input type="text" class="form-control" name="employee_experience"  placeholder="Enter Employee Experience">
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Employeeinsert">Save changes</button>
                    </div>
                </div>
        </div>
</div>
<!-- model content in Employee add form End -->

<script>

$(document).ready(function(){

    // Admin Script List
        // Fetch user Data
        var tables = $('#example2').DataTable({               
            ajax: "{{ route('user.getdata') }}",
            columns: [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": null,
                    render: function(data, row, type) {
                        return `<button data-id="${type.id}" class="btn btn-danger deleteuser"><i class="fa fa-trash"></i></button>`;
                    }
                },

              
                
                ],
                rowReorder: {
                selector: 'td:nth-child(2)'
                },
                responsive: true,
           
        });
        // Fetch user Data End

        // Save The userData using In Ajax
        $('#Userinsert').click(function (e) 
        {
                        e.preventDefault();
                        $(this).html('Save');
                    
                        $.ajax({
                        data: $('#Userinsertss').serialize(),
                        url: "{{ route('users.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                                                                            
                            if($.isEmptyObject(data.error)){
                                tables.ajax.reload(); 
                                $('#Userinsertss').trigger("reset");
                                $('#exampleModal').modal('hide');
                                $('#success').fadeIn().html(data['success']);
                                setTimeout(function function_name() {
                                $('#success').fadeOut('slow');
                                }, 1000);

                                
                            }else{
                                printErrorMsg(data.error);
                            }
                        
                        },
                        error: function (data) {
                            //console.log('Error:', data);
                            $('#Userinsert').html('Save Changes');
                        }
                    });
        });
        // Save The userData using In Ajax End

        //    validation Alert Function
        function printErrorMsg (msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( msg, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
        }
        //    validation Alert Function End

        // Delete User Data using id
        $(document).on('click','.deleteuser',function(e){
            swal({   
            title: "Are you sure?",   
            text: "You will not be able to User Data!",   
            type: "warning", 
            buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
            ],  
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
            }).then(isConfirmed => { 
            if(isConfirmed) {

               const id=$(this).attr('data-id');
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({

                        url:"{{ route('user.destroy') }}",
                        type: "GET",
                        dataType: 'json',
                        data:{id:id},
                        success: function (data) {
                            
                            tables.ajax.reload(); 
                            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 

                        
                            
                        }     
                    });
            }
            });
        });
        // Delete User Data using id End

    // Admin Script List End

    // User Script List

            //   Get Employee code
            load_serviceid();

            function load_serviceid()
            {
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                                    
                $.ajax({

                    url:"{{ route('getemployeeid') }}",
                    type:"GET",
                    success:function(response)
                    {
                        console.log(response);
                        $('#employee_code').val(response);
                    }


                });
            }
            //   Get Employee code End

        // Fetch user Data
            var table1 = $('#example1').DataTable({               
                ajax: "{{ route('employee.getdata') }}",
                columns: [{
                        "data": "employee_id"
                    },
                    {
                        "data": "employee_name"
                    },
                    {
                        "data": "employee_department"
                    },
                    {
                        "data": "employee_age"
                    },
                    {
                        "data": "employee_experience"
                    },
                    {
                        "data": null,
                        render: function(data, row, type) {
                            return `<button data-id="${type.id}" class="btn btn-danger deleteemployee"><i class="fa fa-trash"></i></button>`;
                        }
                    },

                
                    
                    ],
                    rowReorder: {
                    selector: 'td:nth-child(2)'
                    },
                    responsive: true,
            
            });
        // Fetch user Data End
    
            // Save The userData using In Ajax
                $('#Employeeinsert').click(function (e) 
                {
                            e.preventDefault();
                            $(this).html('Save');
                        
                            $.ajax({
                            data: $('#employeeinsertss').serialize(),
                            url: "{{ route('employee.store') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (data) {
                                                                                
                                if($.isEmptyObject(data.error)){
                                    load_serviceid();
                                    table1.ajax.reload(); 
                                    $('#employeeinsertss').trigger("reset");
                                    $('#exampleModal1').modal('hide');
                                    $('#success').fadeIn().html(data['success']);
                                    setTimeout(function function_name() {
                                    $('#success').fadeOut('slow');
                                    }, 1000);
                                    
                                }else{
                                    printErrorMsg1(data.error);
                                }
                            
                            },
                            error: function (data) {
                                //console.log('Error:', data);
                                $('#Employeeinsert').html('Save Changes');
                            }
                        });
                });
            // Save The userData using In Ajax End

            //    validation Alert Function
                function printErrorMsg1 (msg) {
                            $(".print-error-msg1").find("ul").html('');
                            $(".print-error-msg1").css('display','block');
                            $.each( msg, function( key, value ) {
                                $(".print-error-msg1").find("ul").append('<li>'+value+'</li>');
                            });
                }
            //    validation Alert Function End
  
            // Delete User Data using id
                $(document).on('click','.deleteemployee',function(e){
                    swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to User Data!",   
                    type: "warning", 
                    buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                    ],  
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                    }).then(isConfirmed => { 
                    if(isConfirmed) {

                    const id=$(this).attr('data-id');
                            $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            });
                            $.ajax({

                                url:"{{ route('employee.destroy') }}",
                                type: "GET",
                                dataType: 'json',
                                data:{id:id},
                                success: function (data) {
                                    
                                    table1.ajax.reload(); 
                                    swal("Deleted!", "Your imaginary file has been deleted.", "success"); 

                                
                                    
                                }     
                            });
                    }
                    });
                });
        // Delete User Data using id End

        // csv import script here
       
        $('#Employeeimport').click(function (e) 
                {
                            e.preventDefault();
                            $(this).html('Save');
                        
                            $.ajax({
                            data: $('#employeeimport').serialize(),
                            url: "{{ route('employee.import') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (data) {
                                                                                
                                if($.isEmptyObject(data.error)){
                                    load_serviceid();
                                    table1.ajax.reload(); 
                                    $('#employeeimport').trigger("reset");
                                    $('#exampleModal3').modal('hide');
                                    $('#success').fadeIn().html(data['success']);
                                    setTimeout(function function_name() {
                                    $('#success').fadeOut('slow');
                                    }, 1000);
                                    
                                }else{
                                    printErrorMsg1(data.error);
                                }
                            
                            },
                            error: function (data) {
                                //console.log('Error:', data);
                                $('#Employeeinsert').html('Save Changes');
                            }
                        });
                });
       
        // csv import script here End

    // User Script List End


});
</script>
@endsection
           