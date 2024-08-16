$(document).ready(function(){
    $(".search-form").submit(function(e)
    {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var exam_year =  $(".exam-year").val();
        var select_exam =  $(".select-process-term").val();
        var position_no =  $(".position_no").val();

        $.ajax({
            url:  "/result-annoucement",
            method: 'GET',
            data:{
                position_no:position_no,
                current_year:exam_year,
                select_exam:select_exam
            },
            beforeSend: function() 
            {
             // setting a timeout
            //   $(".loading-th").removeClass("d-none");
    
              $(".position-table").html(`
                    <center class="d-flex justify-content-center">
                        <span>Loading </span>
                        <span class="px-3">
                            <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                        </span>
                    </center>
                `);
    
            },
             // Success 
             success:function(response)
             {
                console.log(response);
                $(".position-table").html('');

                if(response.message)
                {
                  $(".position-table").html(`<div class="text-center">`+response.message+`</div>`);
                }

                // Iterate through the students_by_class_and_section array
                response.students_by_class_and_section.forEach(function(classData) {
                    for (const section in classData) {
                        // Create a table for each class and section combination
                        const table = `
                        <div class="d-flex justify-content-center">
                            <b class="px-1">Class: </b>
                            <span class="class-name"> `+classData[section][0].class+' '+classData[section][0].section+` </span>
                        </div>
                        <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Total Marks</th>
                            </tr>
                        </thead>
                        <tbody class="exam-timetable-table">
                   

                        </tbody>
                    </table>`;
                
                        // Append the table to the position-table container
                        $(".position-table").append(table);
                
                        // Get the student data for the current section
                        const sectionData = classData[section];

                        // console.log(classData[section][0].class);
                
                        // Iterate through the section data to add rows to the table
                        sectionData.forEach(function(student, index) {
                            // Calculate the position within the section
                            const position = index + 1;

                            var positionName = "";
                            if(position == 1){
                                positionName = "First";
                            }
                            if(position == 2){
                                positionName = "Second";
                            }
                            if(position == 3){
                                positionName = "Third";
                            }
                            if(position == 4){
                                positionName = "Fourth";
                            }
                            if(position == 5){
                                positionName = "Fifth";
                            }
                
                            // Create a row for each student
                            const row = `<tr>
                                <td>${positionName}</td>
                                <td>${student.first_name} ${student.middle_name} ${student.last_name}</td>
                                <td>${student.total_subject_marks}</td>
                            </tr>`;
                
                            // Append the row to the table
                            $(`.position-table table:last tbody.exam-timetable-table`).append(row);
                        });
                    }
                });


                


 
             },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });


    });
});