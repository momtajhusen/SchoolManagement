// Student Retrive 
$(document).ready(function(){
   $(".search-student").submit(function(e){
      e.preventDefault();

      $(".marks-entry").html('');
      $("#enter-subject").html('');
      $("#searchInput").val('');
  
      var select_exam = $("#select_exam").val();
      var select_class = $(".class-select").val();
      var select_section = $(".section-select").val();
      var select_subject = $(".select-subject").val();

      var current_year = NepaliFunctions.GetCurrentBsDate().year;

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "/get-studen-mark-entry",
        method: 'GET',
        data:{
            select_exam:select_exam,
            select_subject:select_subject,
            current_year:current_year,
            select_class : select_class,
            select_section : select_section,
        },
        beforeSend: function() 
        {
         // setting a timeout
        //   $(".loading-th").removeClass("d-none");

          $(".marks-entry").html(`
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

            $(".loading-th").addClass("d-none");

            if(response.message != "data not found"){

                var select_subject = $(".select-subject").val();


             var index = 1;
             $("#enter-subject").html(select_subject);
             response.student_data.forEach(function(item, index) {
                var sn = index + 1;
                var id = item.id;
                var first_name = item.first_name;
                var middle_name = item.middle_name;
                var last_name = item.last_name;
                var roll_no = item.roll_no;
            
                var total_marks = item.total_marks;
                var marks_obtained = item.marks_obtained;
                var minimum_marks = item.minimum_marks;
                var attendance = item.attendance;
            
                var Required = (index === 0) ? 'required' : '';
                var NameTotalMark = (index === 0) ? 'name="total_marks"' : '';
                var NameMinimumMark = (index === 0) ? 'name="minimum_marks"' : '';

            
                $(".marks-entry").append(`
                <tr id="`+id+`">
                    <td>`+id+`</td>
                    <td>`+roll_no+`</td>
                    <td>`+first_name+' '+middle_name+' '+last_name+`</td>
                    <td>
                        <input type="hidden" value="`+id+`" name="st_id[]">
                        <input type="number" value="`+marks_obtained+`" name="marks_obtained[]">
                    </td>
                    <td>
                        <input type="number" value="`+total_marks+`" `+Required+` `+NameTotalMark+`>
                    </td>
                    <td>
                        <input type="number" value="`+minimum_marks+`" `+Required+` `+NameMinimumMark+`>
                    </td>
                    <td>
                        <select name="attendance[]" required class="select p-2 px-4">
                            <option value="Present"` + (attendance === 'Present' ? ' selected' : '') + `>Present</option>
                            <option value="Absent"` + (attendance === 'Absent' ? ' selected' : '') + `>Absent</option>
                        </select>
                    </td>
                </tr>
                `);
            });
             
            }
            else if(response.message == "data not found"){
 
                $(".marks-entry").html('');
             $(".marks-entry").append(`
             <tr>
             <td>Student not found !</td>
             </tr>
             `);
            }
 
         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });


   });
});

// Entry Marks 
$(document).ready(function(){
    $(".entry-mark-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       var select_exam = $("#select_exam").val();
       var class_select = $(".class-select").val();
       var section_select = $(".section-select").val();
       var select_subject= $(".select-subject").val();

       var current_year = NepaliFunctions.GetCurrentBsDate().year;


        var formData = new FormData(this);
        formData.append("current_year", current_year);
        formData.append("select_exam", select_exam);
        formData.append("class_select", class_select);
        formData.append("section_select", section_select);
        formData.append("select_subject", select_subject);

        $.ajax({
            url: "/entry-mark",
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
             // setting a timeout
               $(".submit-btn").addClass('d-none');
               $(".progress").removeClass('d-none');
            },
            // Progress 
                 xhr: function(){
                     var xhr = new window.XMLHttpRequest();
                     xhr.upload.addEventListener("progress", function(evt) {
                         if (evt.lengthComputable) {
                             var percentComplete = (evt.loaded / evt.total) * 100;
                             var percentComplete =  percentComplete.toFixed(2);
                             $(".progress-bar").width(percentComplete+"%");
                             $(".progress-bar").html(percentComplete+" %");
     
                         }
                     }, false);
                     return xhr;
                 },
             // Success 
            success:function(response)
            {
                alert(response.status);
                console.log(response);
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
     
    

    });
});

$(document).ready(function(){
    $("#select_exam, .subject-class, .section-select, .select-subject").on("change", function(){
        $(".marks-entry").html('');
    });
});

$(document).ready(function(){
    $(".select-subject").on("change", function(){
       $("#search-btn").click();
    });
});


 

