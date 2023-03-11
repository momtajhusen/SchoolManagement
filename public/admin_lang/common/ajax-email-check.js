// Techer Email Check 
$(document).ready(function(){
    $("#teacher-email").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var email = $(this).val();

        $.ajax({
            url: "/check-teacher-email",
            method: "POST",
            data:{
                email: email,
            },
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response){
                if(response.status == "email exists")
                {
                   alert("Email Already Use ! Change Email");
                   $("#teacher-email").val("");
                }
            },
        });

       }
    });

 
});

// Student Email Check 
$(document).ready(function(){
    $("#student-email").on("focusout", function(events){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var email = $(this).val();

        $.ajax({
            url: "/check-student-email",
            method: "POST",
            data:{
                email: email,
            },
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response){
                if(response.status == "email exists")
                {
                   alert("Student Email Already Use ! Change Email");
                   $("#student-email").val("");
                }
            },
        });

       }
    });
});

// Father Email Check 
$(document).ready(function(){
    $("#father_email").on("focusout", function(){
       if($(this).val() != "")
       {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var email = $(this).val();

        $.ajax({
            url: "/check-father-email",
            method: "POST",
            data:{
                email: email,
            },
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response){
                if(response.status == "email exists")
                {
                   alert("Father Email Already Use ! Change Email");
                   $("#father_email").val("");
                }
            },
        });

       }
    });

 
});

// Email Spacing Remove 
$(document).ready(function() {
    $('input[type="email"]').on("keydown", function(event) {
      // Check if the "space" key was pressed
      if (event.key === " ") {
        event.preventDefault();
      }
    });
  });