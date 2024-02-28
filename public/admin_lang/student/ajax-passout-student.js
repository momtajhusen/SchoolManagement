// Get Passout All Year 
$(document).ready(function(){
    $.ajax({
        url: "/get-passout-year",
        method: 'GET',
         // Success 
        success:function(response)
        {
 
            var yearData = response.YearData; // access the YearData array
  
            $(".select-year").html(``);
            $(".select-year").append(`<option value="">Select Year</option>`);
            for (var i = 0; i < yearData.length; i++) {
                var year = yearData[i];
                console.log(year); // log each year to the console
                // do something with each year
 
                $(".select-year").append(`<option value="`+year+`">`+year+`</option>`);
            }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});


// Get Passout All Class Select Year
$(document).ready(function(){
   $("#select-year").on("change", function(){
      var select_year = $(this).val();

      $.ajax({
        url: "/get-passout-class",
        method: 'GET',
        data:{
            select_year:select_year,
        },
         // Success 
        success:function(response)
        {

 
            var ClassData = response.ClassData; // access the YearData array
            
            $(".class-select").html(``);
            $(".class-select").append(`<option value="">Select Class</option>`);
            for (var i = 0; i < ClassData.length; i++) {
                var classes = ClassData[i];
 
                // do something with each year
 
                $(".class-select").append(`<option value="`+classes+`">`+classes+`</option>`);
            }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

   });
});


// Get Pasout All Student
$(document).ready(function(){
    $("#class-select").on("change", function(){
       var select_year = $("#select-year").val();
       var select_class = $(this).val();

 
       $.ajax({
         url: "/get-passout-student",
         method: 'GET',
         data:{
            select_year:select_year,
            select_class:select_class,
         },
          // Success 
         success:function(response)
         {
 
             $(".student-select").html(``);
             $(".student-select").append(`<option value="">Select Student</option>`);

            var studentData = response.StudentData;
            for (var i = 0; i < studentData.length; i++) {
                var student = studentData[i];

                var student_name = student.first_name+" "+student.middle_name+" "+student.last_name;

                $(".student-select").append(`<option value="`+student.id+`">`+student_name+`</option>`);
              }
 
         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
     });
 
    });
 });

 
// Get Student Details
$(document).ready(function(){
   $(".search-btn").click(function(){
    var select_year = $("#select-year").val();
    var select_class = $("#class-select").val();
    var student_id = $(".student-select").val();


    $.ajax({
      url: "/get-passout-student-details",
      method: 'GET',
      data:{
         select_year:select_year,
         select_class:select_class,
         student_id:student_id,
      },
       // Success 
      success:function(response)
      {

         var student_img = response.StudentDetails.student_image;
         var studen_name = response.StudentDetails.first_name+" "+response.StudentDetails.middle_name+" "+response.StudentDetails.last_name;
         var student_class = response.StudentDetails.class;
         var st_id = response.StudentDetails.id;

         var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

         $(".student_img").attr("src", currentDomainWithProtocol+"/storage/"+student_img);
         $(".student-name").html(studen_name);
         $(".passout-class").html(student_class);
         $(".st_id").html(st_id);

 
 
         var yearFeeArray = response.YearFee;

         console.log(response.YearFee);

 
         $(".back-year-fee-table").html(``);
         for (var i = 0; i < yearFeeArray.length; i++) {
             var class_year = yearFeeArray[i].class_year;
             var classes = yearFeeArray[i].class;
             var total_fee = yearFeeArray[i].total_fee;
             var total_payment = yearFeeArray[i].total_payment;
             var total_discount = yearFeeArray[i].total_discount;

             var dues = Math.abs(Number(total_payment) + Number(total_discount) - Number(total_fee));

             var pay_texts = dues == 0 ? "Paid" : "Unpaid";
             var pay_bg = dues == 0 ? "bg-success" : "bg-danger";


              $(".back-year-fee-table").append(`  
              <tr>
              <td>`+i+`</td>
              <td>`+class_year+`</td>
              <td>`+classes+`</td>
              <td>`+total_fee+`</td>
              <td>`+total_payment+`</td>
              <td>`+total_discount+`</td>
              <td>`+dues+`</td>
              <td>
                <button class=" `+pay_bg+` border-0 text-light rounded px-4">`+pay_texts+`</button>
               </td>
             </tr>`);
              
         }
 
      },
      error: function (xhr, status, error) 
      {
          console.log(xhr.responseText);
      },
    });

   });
});