
$(document).ready(function(){
    $(".table-body").on("click", "#check-out-student", function(){ 
        var st_id = $(this).attr("st_id"); 
        $("#st_id-input").val(st_id);
        $("#exampleModal").modal('show');

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //   });

          
        //   $.ajax({
        //     url: "/admin/total-fee-kickout",  
        //     method: "GET", 
        //     data: {
        //         st_id: st_id,
        //     },
        //     success: function (response) {
        //         // alert(response);
        //     },
            
        //     error: function (xhr, status, error) {
        //         // Error callback function
        //         console.log(xhr.responseText); // Log the error response in the console
        //     },
        // });


    });
});

$(document).ready(function(){
    $("#model-save-btn").click(function(){

        var st_id = $("#st_id-input").val();
        
        var kickout_month = $("#month").val();
        if(kickout_month == ""){
          alert("Select Kick out Month");
          return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          Swal.fire({
            title: 'Are you sure kick out?',
            text: "Please note that kick out this student will not remove all associated data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Kick Out it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/admin/kick-out-student",  
                    method: "POST", 
                    data: {
                        st_id: st_id,
                        kickout_month: kickout_month,
                        current_year: current_year,

                    },
                    success: function (response) {
                        if (response.message == "save sucess") {
                            Swal.fire({
                                title: 'Kick Out Success',
                                text: "Student Remove",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $("#exampleModal").modal('hide');
                                 $(".search-student").click();
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


