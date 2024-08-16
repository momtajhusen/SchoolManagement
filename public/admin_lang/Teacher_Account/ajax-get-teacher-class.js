// Retrive Teacher Class
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //  Teacher Class 
    $.ajax({
        url: "/teacher/get-teacher-class",
        method: 'GET',
         // Success 
         success:function(response)
         {

            console.log(response.TeacherClass);
 
            if(!response.TeacherClass.length == 0)
            {

                $(".class-select").append(`<option value="">Select Class</option>`);
                var count = 0;
                response.TeacherClass.forEach(function(data){
                 var index = count++;

                    $(".class-select").append(`
                        <option value="`+data.class+`">`+data.class+`</option>
                    `);
                });

            }
            else{
                $(".class-select").append(`<option value="">class not assign</option>`);
            }

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });

//  Teacher Subject 
    $.ajax({
        url: "/teacher/get-teacher-subject",
        method: 'GET',
         // Success 
         success:function(response)
         {

            console.log(response.TeacherSubject);

            if(!response.TeacherSubject.length == 0)
            {
                $(".select-subject").append(`<option value="">Select Subject</option>`);
                response.TeacherSubject.forEach(function(data){
                    $(".select-subject").append(`
                        <option value="`+data.subject+`">`+data.subject+`</option>
                    `);
                });

            }
            else{
                $(".select-subject").append(`<option value="">subject not assign</option>`);
            }

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });
});

// Get Section Class change
$(document).ready(function(){
    $(".class-select").change(function () {
        var classvalue = $(this).val();

        $.ajax({
            url: "/teacher/class-section",
            method: "GET",
            data: {
                class: classvalue,
                current_year: current_year,
            },
        // Success
        success: function (response) {

       // Access the class data from the response
       var classes = response.data;

       // Loop through the classes and do something with each class object
       $(".section-select").html('');
       $(".section-select").append(`<option value="">Please Select Section *</option>`);
       $(".student_roll").val(``);
       for (var i = 0; i < classes.length; i++) {
           var classObj = classes[i];
           console.log(classObj.class);
           console.log(classObj.section);
           console.log(classObj.capacity);
           // ... and so on

           $(".section-select").append(`<option value="`+classObj.section+`">`+classObj.section+`</option>`);
       }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
        });

    }); 
});