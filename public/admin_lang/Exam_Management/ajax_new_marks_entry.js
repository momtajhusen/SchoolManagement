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

                 var total_th = item.total_th;
                 var total_pr = item.total_pr;
                 var pass_th = item.pass_th;
                 var pass_pr = item.pass_pr;
                 var obt_th_mark = item.obt_th_mark;
                 var obt_pr_mark = item.obt_pr_mark;
                 var grade_name = item.grade_name;
                 var remark = item.remark;


             
                 var Required = (index === 0) ? 'required' : '';
                 var NameTotalMark = (index === 0) ? 'name="total_marks"' : '';
                 var NameMinimumMark = (index === 0) ? 'name="minimum_marks"' : '';

                 $('#total_th').val(removeTrailingZeros(total_th));
                 $('#total_pr').val(removeTrailingZeros(total_pr));
                 $('#pass_th').val(removeTrailingZeros(pass_th));
                 $('#pass_pr').val(removeTrailingZeros(pass_pr));
 
             
                 $(".marks-entry").append(`
                    <tr>
                        <td class="font-weight-bold">`+sn+`</td>
                        <td class="text-center">`+first_name+' '+middle_name+' '+last_name+`</td>
                        <td class="text-center">`+removeTrailingZeros(total_th)+`</td>
                        <td class="text-center">`+removeTrailingZeros(total_pr)+`</td>
                        <td class="text-center">`+removeTrailingZeros(pass_th)+`</td>
                        <td class="text-center">`+removeTrailingZeros(pass_pr)+`</td>
                        <td class="text-center">
                           <input type="hidden" value="`+id+`" name="st_id[]">
                           <input type="number" step="0.01" oninput="limitDecimalPlaces(this)" class="text-center obt_th_mark" name="obt_th_mark[]" value='`+removeTrailingZeros(obt_th_mark)+`' style="width:50px;">
                        </td>
                        <td class="text-center">
                           <input type="number" step="0.01" oninput="limitDecimalPlaces(this)" class="text-center obt_pr_mark" name="obt_pr_mark[]" value='`+removeTrailingZeros(obt_pr_mark)+`' style="width:50px;">
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

        var total_th = $("#total_th").val();
        var total_pr = $("#total_pr").val();
        var pass_th = $("#pass_th").val();
        var pass_pr = $("#pass_pr").val();

 
        var current_year = NepaliFunctions.GetCurrentBsDate().year;
 
 
         var formData = new FormData(this);
         formData.append("current_year", current_year);
         formData.append("select_exam", select_exam);
         formData.append("class_select", class_select);
         formData.append("section_select", section_select);
         formData.append("select_subject", select_subject);

         formData.append("total_th", total_th);
         formData.append("total_pr", total_pr);
         formData.append("pass_th", pass_th);
         formData.append("pass_pr", pass_pr);
 
 
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

 function removeTrailingZeros(number) {
    return parseFloat(number).toFixed(2).replace(/\.?0+$/, '');
  }

  function limitDecimalPlaces(input) {
    if (input.value.includes('.') && input.value.split('.')[1].length > 2) {
        input.value = parseFloat(input.value).toFixed(2);
    }
}

// Total  Mark Enter Conditions 
$(document).ready(function(){
    // Update the values of total_th and total_pr when they change
    $('#total_th').on('input', function() {
        total_th = parseFloat($(this).val());
    });

    $('#total_pr').on('input', function() {
        total_pr = parseFloat($(this).val());
    });

    // Event handler for pass_th input
    $('#pass_th').on('input', function(){
        var pass_th = parseFloat($(this).val()); // Get the current value of pass_th

        // Check if pass_th is greater than or equal to total_th
        if (pass_th >= total_th) {
            $(this).val(total_th); // Set pass_th to total_th
        }
    });

    // Event handler for pass_pr input
    $('#pass_pr').on('input', function(){
        var pass_pr = parseFloat($(this).val()); // Get the current value of pass_pr

        // Check if pass_pr is greater than or equal to total_pr
        if (pass_pr >= total_pr) {
            $(this).val(total_pr); // Set pass_pr to total_pr
        }
    });
});

// Obtained Mark Condition 
$(document).ready(function(){
    $(".marks-entry").on("input", ".obt_th_mark", function(){  
        var obt_th_mark = parseFloat($(this).val()); 
        var total_th = parseFloat($('#total_th').val()); // Update total_th inside event handler

        if (obt_th_mark >= total_th) {
            $(this).val(total_th); 
        }
    });

    $(".marks-entry").on("input", ".obt_pr_mark", function(){  
        var obt_pr_mark = parseFloat($(this).val()); 
        var total_pr = parseFloat($('#total_pr').val()); // Update total_pr inside event handler

        if (obt_pr_mark >= total_pr) {
            $(this).val(total_pr); 
        }
    });
});

// Select Input Number on click 
$(document).ready(function(){
    $(".marks-entry").on("click", ".obt_th_mark,.obt_pr_mark", function(){   
        $(this).select();
    });

    $(".marks-entry").on("click", "#total_th,#total_pr", function(){   
        $(this).select();
    });

    $('#total_th,#total_pr,#pass_th,#pass_pr').on('click', function() {
        $(this).select();
    });
});

 
 