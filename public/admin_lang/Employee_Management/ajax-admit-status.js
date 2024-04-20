// Employee leaved 

$(document).ready(function(){
    $(".table-body").on("click", "#leaved-employee", function()
    { 

        var emp_id = $(this).attr('emp_id');
       
       Swal.fire({
           title: 'Are you sure leaved ?',
           text: "Please note that leaved employee aur safe you can return restore.",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, leaved it!'
         }).then((result) => {
           if (result.isConfirmed) {
       
     
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
    
               $.ajax({
                   url:  "/employee-leaved",
                   method: 'POST',
                   data:{
                    emp_id:emp_id,
                   },
                   // Success 
                   success:function(response)
                   {
                   if(response.message == 'leaved success'){
                       Swal.fire({
                           title: 'Leaved Success',
                           text: "Employee data has been leaved",
                           icon: 'success',
                           showConfirmButton: false,
                           timer: 1500
                       });
                   }
                   },
                   error: function (xhr, status, error) 
                   {
                   console.log(xhr.responseText);
                   },
               });
    
           }
           });
    });
    
});


