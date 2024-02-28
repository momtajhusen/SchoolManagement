// Delete 
$(document).ready(function(){
    $(".table-body").on("click", "#delete_employee", function()
    {  

        var emp_id = $(this).attr("emp_id");
 
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         });
         
 
         Swal.fire({
            title: 'Are you sure delete this employee ?',
            text: " Please note this deleting employee will permanently remove all associated data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/admin/delete-employee", 
                    method: "POST", 
                    data: {
                        emp_id: emp_id, 
                    },
                    success: function (response) {
 
                        if (response.message == "Employee deleted successfully") {
                            Swal.fire({
                                title: 'Delete Success',
                                text: "Employee data has been deleted",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    
                    error: function (xhr, status, error) {
                        // Error callback function
                        console.log(xhr.responseText); // Log the error response in the console
                    },
                });
                
            }
          });
    });
});