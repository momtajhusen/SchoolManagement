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
            // Success
            success: function (response){
                if(response.status == "number exists")
                {
                   alert("Student Number Already Use ! Change Number");
                   $("#student_number").val("");
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

// Father Number Check 
$(document).ready(function(){
    $("#father_number").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var number = $(this).val();

        $.ajax({
            url: "/check-father-number",
            method: "POST",
            data:{
                number: number,
            },
            // Success
            success: function (response){
                if(response.status == "number exists")
                {
                   alert("Father Number Already Use ! Change Number");
                   $("#father_number").val("");
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

// Mother Number Check 
$(document).ready(function(){
    $("#mother_number").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var number = $(this).val();

        $.ajax({
            url: "/check-mother-number",
            method: "POST",
            data:{
                number: number,
            },
            // Success
            success: function (response){
                if(response.status == "number exists")
                {
                   alert("Mother Number Already Use ! Change Number");
                   $("#mother_number").val("");
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

// Teacher Number Check 
$(document).ready(function(){
    $("#teacher_number").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var number = $(this).val();

        $.ajax({
            url: "/check-teacher-number",
            method: "POST",
            data:{
                number: number,
            },
            // Success
            success: function (response){
                if(response.status == "number exists")
                {
                   alert("Number Already Use ! Change Number");
                   $("#teacher_number").val("");
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


// Driver Number Check 
$(document).ready(function(){
    $("#driver_number").on("focusout", function(){
       if($(this).val() != "")
       {

        if($("#check_action").val() == "add")
        {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
           var number = $(this).val();
    
            $.ajax({
                url: "/check-drive-number",
                method: "POST",
                data:{
                    number: number,
                },
                // Success
                success: function (response){
                    if(response.status == "number exists")
                    {
                       alert("Number Already Use ! Change Number");
                       $("#driver_number").val("");
                    }
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });
        }
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
    });

    $(".mobile-number").each(function(){
        $(this).on("focusout", function(){
            if($(this).val() != "")
            {
                if($(this).val().length !=  "10")
                {
                   alert("please enter 10 digit number");
                   $(this).val("");
                } 
            }
        });
    });
});

