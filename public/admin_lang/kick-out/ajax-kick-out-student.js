// Kick out students options 
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-kick-out",
        method: "GET",
        // Success
        success: function (response) {
 
           console.log(response.StudentData);

           response.StudentData.forEach(function(student){

               var student_name = student.first_name+" "+student.middle_name+" "+student.last_name;
               var st_id = student.id;

                $(".student-select").append(`<option value="`+student.id+`">id: ${st_id} name: ${student_name}</option>`);

           });

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });


});

// Get Student Details
$(document).ready(function(){
    $(".search-btn").click(function(){
 
     var student_id = $(".student-select").val();

     $.ajax({
       url: "/get-kickout-student-details",
       method: 'GET',
       data:{
          student_id:student_id,
       },
        // Success 
       success:function(response)
       {

        console.log(response);
 
          var student_img = response.StudentDetails.student_image;
          var studen_name = response.StudentDetails.first_name+" "+response.StudentDetails.middle_name+" "+response.StudentDetails.last_name;
          var student_class = response.StudentDetails.class;
          var roll_no = response.StudentDetails.roll_no;
          var st_id = response.StudentDetails.id;
          var kickout_date = response.StudentDetails.status_date;

          var kickout_dateString = kickout_date;
          var YearMonth = kickout_dateString.split('-');
          var KickOutYear = YearMonth[0];
          var KickOutMonth = YearMonth[1];
          KickOutMonth = Number(KickOutMonth)-1;

          KickOutMonth = NepaliFunctions.GetBsMonths()[KickOutMonth];

 
          var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
 
          $(".student_img").attr("src", currentDomainWithProtocol+"/storage/"+student_img);
          $(".student-name").html(studen_name);
          $(".passout-class").html(student_class);
          $(".st_id").html(st_id);
          $("#re-enter-btn").attr("st_id", st_id);
          $(".kickout-date").html(KickOutYear+"-"+KickOutMonth);
 
  
  
          var yearFeeArray = response.YearFee;
 
          console.log(response.YearFee);
 
  
          $(".back-year-fee-table").html(``);
          for (var i = 0; i < yearFeeArray.length; i++) {
              var class_year = yearFeeArray[i].class_year;
              var classes = yearFeeArray[i].class;
              var total_fee = yearFeeArray[i].total_fee;
              var total_payment = yearFeeArray[i].total_payment;
              var total_discount = yearFeeArray[i].total_discount;
 
              var payment = Math.abs(Number(total_payment) + Number(total_discount));

              var dues = Math.abs(Number(total_payment) + Number(total_discount) - Number(total_fee));
 

              if(total_fee <= payment)
              {
               var pay_texts = "Paid";
               var pay_bg = "bg-success";
               var dues = 0;
              }
              else{
                var pay_texts = "Unpaid";
                var pay_bg = "bg-danger";
              }
 
 
               $(".back-year-fee-table").append(`  
               <tr>
               <td>`+class_year+`</td>
               <td>`+classes+`</td>
               <td>`+total_fee+`</td>
               <td>`+total_payment+`</td>
               <td>`+total_discount+`</td>
               <td>`+dues+`</td>
               <td>
                 <button class=" `+pay_bg+` border-0 text-light rounded px-4">`+pay_texts+`</button>
                </td>
                <td>
                  <button id="year-fee-details" year="`+class_year+`" st_id="`+st_id+`" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Check Fee Detaild" data-toggle="modal" data-target="#lastyearfeedetails">
                      <span class="material-symbols-outlined" style="font-size:10px;">history</span>
                  </button>
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

