//All Admit Students Select Option 
$(document).ready(function(){
    $.ajax({
        url: "/get-all-admit-student",
        method: 'GET',
         // Success 
        success:function(response)
        {
            console.log(response);
            
            $(".admit-students-select").html('');
            $(".admit-students-select").append('<option value="">Select Student</option>');
            
            response.studentsData.forEach(function(student) {
                $(".admit-students-select").append(`
                    <option st_id='${student.student_id}' value="${student.parent_id}">${'id: '+student.student_id+' '+'name: '+student.student_name}</option>
                `);
            });
            
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});