

// single payment reset 
$(document).ready(function(){
    $(".history-table").on("click", ".reset-payment-btn", function(){

        var class_select = $(".class-select").val();
        var student_id = $(this).attr("student_id");
        var history_id = $(this).attr("history_id");

        Swal.fire({
            title: 'Are You Sure Reset Last Payment ?',
            text: "You want to reset payment",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reset it!'
          }).then((result) => {
            if (result.isConfirmed) {

                
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: "/reset-payment",
                    method: "POST",
                    data: {
                        class_select: class_select,
                        year: current_year,
                        student_id: student_id,
                        history_id: history_id,
                    },
                    success(response){

                        console.log(response);

                        if(response == "Reset Success")
                        {
                            Swal.fire(
                                "Payment Reset Success !",
                                "You clicked the button!",
                                "success"
                            );
                        }
                        
                      $(".search-btn").click();
                    },
                    error: function (xhr, status, error) {
                      // Parse the response JSON if available
                      let errorMessage = 'An error occurred.';
                      if (xhr.responseJSON && xhr.responseJSON.error) {
                          errorMessage = xhr.responseJSON.error;
                      } else if (xhr.responseText) {
                          // Fallback to the responseText if responseJSON is not available
                          errorMessage = xhr.responseText;
                      }
                      
                      // Display the error message to the user
                      console.error(errorMessage);
                      // You can also update a specific element on your page with the error message
                      // document.getElementById('error-message').innerText = errorMessage;
                  }
                });
            }
          })

    });
});

// all payment reset 
$(document).ready(function(){
    $("#all_reset").click(function(){
      var st_id = $(this).attr("st_id");
  
          $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
  
      Swal.fire({
        title: 'Are you sure reset all payment?',
        text: "Please note that deleting this student will permanently remove all associated payment.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
  
          $.ajax({
              url: "/reset-all-payment",
              method: "POST",
              data: {
                st_id: st_id,
                year: current_year,
              },
              success: function(response) {
                console.log(response);

                if(response == "reset success")
                {
                    Swal.fire(
                        "All Payment Reset Success !",
                        "You clicked the button!",
                        "success"
                    );

                    $(".search-btn").click();
                }
              },
              error: function (xhr, status, error) {
                // Parse the response JSON if available
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (xhr.responseText) {
                    // Fallback to the responseText if responseJSON is not available
                    errorMessage = xhr.responseText;
                }
                
                // Display the error message to the user
                console.error(errorMessage);
                // You can also update a specific element on your page with the error message
                // document.getElementById('error-message').innerText = errorMessage;
            }
          });
  
        }
      })
  
    });
  });