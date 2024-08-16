//All Admit Students Select Option 
$(document).ready(function(){
    $.ajax({
        url: "/get-all-admit-student",
        method: 'GET',
        beforeSend: function() 
        {
            $('.load-box').html(`
               <span>please wait students load <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i></span>
            `);
        },
         // Success 
        success:function(response)
        {
            console.log(response);
            
            $(".admit-students-select").html('');
            $(".admit-students-select").append('<option value="">Select Student</option>');
            
            response.studentsData.forEach(function(student) {
                $(".admit-students-select").append(`
                    <option st_id='${student.student_id}' value="${student.parent_id}">${'st_id: '+student.student_id+ ' &nbsp&nbsp&nbsp '+'cls: '+student.class+' &nbsp&nbsp&nbsp '+'student: '+student.student_name}</option>
                `);
            });


            $('.load-box').html('');
            $('.search-select').click();
            
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});