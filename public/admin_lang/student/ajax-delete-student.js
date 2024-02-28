$(document).ready(function(){
    $(".table-body").on("click", "#student-delete", function()
    {  

        var st_id = $(this).attr("st_id");

        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         });
         
 
         Swal.fire({
            title: 'Are you sure delete student?',
            text: " Please note that deleting this student will permanently remove all associated data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/admin/delete-student", // The URL to send the POST request to
                    method: "POST", // The HTTP method (POST in this case)
                    data: {
                        st_id: st_id,
                    },
                    success: function (response) {
                        if (response.message == "Student deleted successfully") {
                            Swal.fire({
                                title: 'Delete Success',
                                text: "Student data has been deleted",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                // Auto reload the page after the SweetAlert timer ends
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