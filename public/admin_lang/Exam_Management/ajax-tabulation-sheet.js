$(document).ready(function(){
    $(".exam-tabulation-form").submit(function(e){
        e.preventDefault();

        $(".exam-tabulation-thead").html('');
        $(".exam-tabulation-body").html('');



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       var exam_id = $("#select_exam option:selected").attr('exam_id');
        var select_class = $(".class-select").val();
        var select_section = $(".section-select").val();

        $.ajax({
            url:  "/get-exam-tabulation",
            method: 'GET',
            data:{
                exam_id:exam_id,
                select_class : select_class,
                select_section : select_section,
                current_year:current_year,
            },
            beforeSend: function() 
            {
             // setting a timeout
            //   $(".loading-th").removeClass("d-none");
    
              $(".exam-tabulation-table").html(`
              <th colspan="10" class="border loading-th">
                    <center class="d-flex justify-content-center">
                        <span>Loading </span>
                        <span class="px-3">
                            <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                        </span>
                    </center>
                </th>
                `);
            },
             // Success 
             success:function(response)
             {
                console.log(response);

                if(response.message != "Marks not Entry"){
                    var subject_th = "";
                    var subject_marks_items = "";


            
                    
                    response.data[0].exam_marks.forEach(function(item) {
                        subject_th += " <th colspan='2' scope='col'>" + item.subject + "</th>";
                        subject_marks_items += "<td>TH</td><td>PR</td>";
                    });

                    $(".exam-tabulation-thead").html('');
                    $(".exam-tabulation-thead").append(`
                        <tr>
                            <th rowspan="2" scope="col">#</th>
                            <th rowspan="2" scope="col">Student ↓ | Subject →</th>
                             `+subject_th+`
                            <th rowspan="2" scope="col">Percentage</th>
                        </tr>
                        <tr>
                            `+subject_marks_items+`
                        </tr>
                    `);
    
                    var students = response.data;

                    // students.sort(function(a, b) {
                    //     var totalMarksA = 0;
                    //     var totalMarksB = 0;
                    //     a.exam_marks.forEach(function(marks) {
                    //         totalMarksA += parseInt(marks.marks_obtained);
                    //     });
                    //     b.exam_marks.forEach(function(marks) {
                    //         totalMarksB += parseInt(marks.marks_obtained);
                    //     });
                    //     return totalMarksB - totalMarksA;
                    // });
    
                    $(".exam-tabulation-table").html('');
                    $(".exam-tabulation-body").html('');
                    students.forEach(function(item, index) {
                        var sn = index++;
                        var id = item.id;
                        var st_name = item.first_name + " " + item.middle_name + " " + item.last_name;
 
    
                        // var obtained_marks = item.exam_marks[index].obtained_marks;s

 
                        // var percentage = item.exam_grade.percentage;
                        // var grade_name = item.exam_grade.grade_name;
                        // var grade_point = item.exam_grade.grade_point;
    
     
                        var marks_row = '';
                        item.exam_marks.forEach(function(marks) {
                            marks_row += `
                            <td class='text-ceneter'>${removeTrailingZeros(marks.obt_th_mark)}</td>
                            <td class='text-ceneter'>${removeTrailingZeros(marks.obt_pr_mark)}</td>`;
                        });
    
                        $(".exam-tabulation-body").append(`
                            <tr>
                               <td class="text-ceneter">${sn}.</td>
                                <td class="text-ceneter">${st_name}</td>
                                ${marks_row}
                                <td class="text-ceneter">${item.final_percentage}</td>
                            </tr>
                        `);
                    });
                }
                else{
                    $(".exam-tabulation-table").html('');
                    alert("Marks Not Entry for this");
                }
  


             },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });

    });
});

function removeTrailingZeros(number) {
    return parseFloat(number).toFixed(2).replace(/\.?0+$/, '');
  }

// Delete Subject 
$(document).ready(function(){
 
    $(".exam-tabulation-title").on("click", "#subject-delete", function(){

       var subject = $(this).attr('subject');
       var exam_year = $(this).attr('exam_year');
       var exam = $("#select_exam").val();
       var classes = $(".class-select").val();
       var exam_id = $("#select_exam option:selected").attr('exam_id');


       
       $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
       });

       Swal.fire({
        title: "Are you sure delete "+subject+" subject ?",
        text: " Please note that deleting this subject will permanently remove all students marks.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/delete-subject-tabulation",
                method: "POST",
                data: {
                    subject: subject,
                    exam_year: exam_year,
                    exam: exam,
                    classes: classes,
                },
                success(response){
                    console.log(response);
                    if(response.message == "Delete Sucess"){
                        Swal.fire({
                            title: "Delete Success "+subject+" subject !",
                            text: "You clicked the button!",
                            icon: "success",
                            confirmButtonText: "OK",
                          });
                          $("#view-tablution-btn").click();
                    }
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });
        };
    });
});


});

$(document).ready(function(){
    $("select").on("change", function(){
        $(".exam-tabulation-title").html('');
        $(".exam-tabulation-table").html('');
    });
});