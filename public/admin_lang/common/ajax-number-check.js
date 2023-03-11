// Student Number Check 
$(document).ready(function(){
    $("#student_number").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var number = $(this).val();

        $.ajax({
            url: "/check-student-number",
            method: "POST",
            data:{
                number: number,
            },
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response){
                if(response.status == "number exists")
                {
                   alert("Student Number Already Use ! Change Number");
                   $("#student_number").val("");
                }
            },
        });

       }
    });
});

// Valid Mobile Number
$(document).ready(function(){
    $(".mobile-number").on("input", function(event){
      // Remove any non-numeric characters from the input
      var mobileNumber = $(this).val().replace(/\D/g,'');
      
      if(mobileNumber.length > 10) {
        $(this).val(mobileNumber.slice(0,10));
      }

      if (event.key == "e") {
        event.preventDefault();
      }
    });
});