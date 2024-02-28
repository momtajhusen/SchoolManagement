$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/api/aboutschool",
        type: 'GET',
         // Success 
        success:function(response)
        {
            var schools = response;
            for (var i = 0; i < schools.length; i++) {
              var school = schools[i];

            //   alert(school.school_name);
              $(".school-slog").html(school.school_slog);
              $(".school-name").html(school.school_name);

              $(".teacher-no").html(school.teachers);
              $(".class-no").html(school.class);
              $(".student-no").html(school.students);
              $(".hours-no").html(school.hours);
 
            }
        }
    });

});