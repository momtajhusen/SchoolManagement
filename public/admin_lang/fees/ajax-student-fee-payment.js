//  Search icon 
$(document).ready(function(){
    $(".parent-search-icon").click(function(){
        $(".parent-details-box").addClass('d-none');
        $(".student-search-box").removeClass('d-none');
        $(".students-table").html(''); 
    });
});

// select-option choose 
$(document).ready(function(){
    $('.select-option').click(function(){
        $('.select-option').removeClass('selected-option');
        $(this).addClass('selected-option');

        if($(this).html() == 'Students'){
            $(".student-select-box").removeClass('d-none');
            $(".parent-select-box").addClass('d-none');
            $('.admit-parents-select').trigger('click');

        }
        if($(this).html() == 'Parents'){
            $(".student-select-box").addClass('d-none');
            $(".parent-select-box").removeClass('d-none');
        }
    });

    $('.select-option:first').trigger('click');
});

// auto selected up to current month checkbox
$(document).ready(function(){
    var current_month = NepaliFunctions.GetCurrentBsDate().month;
    $(".month-check-input").each(function(index) {
        if (index < current_month) {
            $(this).prop("checked", true);
        }
    });
});

// month unchecked checkbox 
$(document).ready(function(){
    $('.month-check-input').on('click', function() {
        var clickedIndex = $('.month-check-input').index(this);
    
        $('.month-check-input').each(function(index) {
            if (index < clickedIndex) {
                $(this).prop('checked', true);
            } else if (index > clickedIndex) {
                $(this).prop('checked', false);
            }
        });
    });
});

// Start Select parent than retrive stundets 
$(document).ready(function(){
    // on change event
    $(".search-select").on("change", function(){
       var pr_id = $(this).val();
       ParentStudent(pr_id);
    });

    // button click event
    $("#search-btn").click(function(){
        $(".search-select").each(function(){
            if (!$(this).parent().hasClass("d-none")) {
                var pr_id = $(this).val();
                ParentStudent(pr_id);
            }
        });
    });

    // checked & unchecked event 
    $('.month-check-input').each(function(){
        $(this).change(function(){
            if($(this).is(":checked")) {
                $("#search-btn").click();
            } else {
                $("#search-btn").click();
            }
        });
    });

 });

 function ParentStudent(pr_id){

    var selectedMonth = [];
    $('.month-check-input:checked').each(function() {
        selectedMonth.push($(this).val());
    });
 
    $.ajax({
        url: "/parent-student-retrive",
        method: 'GET',
        data:{
            pr_id:pr_id,
            selectedMonth: selectedMonth
        },
         // Success 
        success:function(response)
        {

          console.log(response);

          if(response.status == 'success')
          {
            $(".parent-details-box").removeClass('d-none');
            $(".student-search-box").addClass('d-none');

            var pr_id = response.parent_details.id;
            var father_img = response.parent_details.father_image;
            var father_name = response.parent_details.father_name;
            var father_contact = response.parent_details.father_mobile;

            var ward_no = response.student_details[0].ward_no;
            var village = response.student_details[0].village;
            var municipality = response.student_details[0].municipality;

            $(".total-children").html(response.student_details.length);

            $('.pr-id').html(pr_id);
            $('.parent-image').attr('src','../storage/'+father_img+'');
            $('.father-name').html(father_name);
            $('.father-contact').html(father_contact);
            $('.father-address').html(village);

            if(response.student_details)
            {
                $(".students-table").html(''); 
                var total_fee = 0;
                var total_paid = 0;
                var total_disc = 0;
                var total_dues = 0;
                var all_st_id = [];

                response.student_details.forEach(element => {
                    var student_name = element.first_name+' '+element.last_name;
                    total_fee += element.total_fee;
                    total_paid += element.total_paid;
                    total_disc += element.total_disc;
                    all_st_id.push(element.id);

                    var student_total_fee = element.total_fee - element.total_paid + element.total_disc;

                    total_dues += student_total_fee;


                    $(".students-table").append(`
                        <tr class='students' st_id='`+element.id+`' style='cursor:pointer'>
                            <td>
                               <img class="border p-1 parent-image" src="../storage/`+element.student_image+`" alt="parent" style="width:40px;">
                               <span>`+student_name+`</span>
                            </td>
                            <td class='text-center'>₹ `+element.total_fee+`</td>
                            <td class='text-center'>₹ `+element.total_paid+`</td>
                            <td class='text-center'>₹ `+element.total_disc+`</td>
                            <td class='text-center'>₹ `+student_total_fee+`</td>
                        </tr>
                    `); 
                });

                $('.total-fee-multi').html(total_fee);
                $('.total-paid-multi').html(total_paid);
                $('.total-disc-multi').html(total_disc);
                $('.total-dues-multi').html(total_dues);

                $(".take-pay-multi").attr('dues', total_dues);
                $(".take-pay-multi").attr('all_st_id', all_st_id);
                $(".paid_btn").attr('pr_id', pr_id);


                if(total_dues != 0){
                    $(".take-pay-multi").removeClass('d-none');
                }else{
                    $(".take-pay-multi").addClass('d-none');
                }
            }

          }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
            // $(".students-table").html(''); 
        },
    });
 }
// End Select parent than retrive stundets 

// Take Pay multi get particular
$(document).ready(function(){
    $('.take-pay-multi').click(function(){

        var dues = $(this).attr('dues');
        var all_st_id = $(this).attr('all_st_id');


        $('#fee_input').val(dues);
        $('#paid_input').val(dues);
        $('#dues_input').val(0);
        $('#disc_input').val(0);
        $('#disc_input').val(0);
        $('#percentage').val(0);


        $('.paid_btn').attr('sing_multi', 'multi');
        $('.paid_btn').attr('all_st_id', all_st_id);

        var st_id_array = all_st_id.split(',');
        var fee_year = NepaliFunctions.GetCurrentBsDate().year;
        var month_array = [];
        $('.month-check-input:checked').each(function() {
            var value = $(this).val();
            var monthNumber = parseInt(value.replace('month_', '')) + 1; // Extract number and add 1
            month_array.push(monthNumber);
        });

        var UptoMonth = NepaliFunctions.GetBsMonths()[month_array.length -1 ];

        $('.up-to-month').html('Up to '+UptoMonth);



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url: "/student-fee-month-particular",
            method: "GET", 
            data: {
                month_array: month_array,
                fee_year: fee_year,
                st_id_array: st_id_array,
            },
            success: function (response) {

                console.log(response);
 
                if (response.status === 'success') {
                    var data = response.data;
                    // Iterate over each student

                    var student_tr = '';
                    var common_fee_particular_tr = '';
                    $.each(data, function (studentId, studentData) {
                        var studentDetails = studentData.student_details;
                        var feeDetails = studentData.fee_details;
                        var commonFeeDetails = response.common_fee_details;
                        
            

                        var st_id = studentDetails.id;
                        var student_name = studentDetails.first_name+' '+ studentDetails.last_name;
                        var classes = studentDetails.class+' '+studentDetails.section;
                        var student_img = studentDetails.student_image;


                        student_tr += `
                        <tr>
                            <th class="text-center" style="width:30px;">
                                <img src="../storage/`+student_img+`" class="border" alt="" style="width:25px;height:25px;">
                            </th>
                            <th colspan="4">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <span style="font-size: 12px;">`+student_name+`</span>
                                    <div class="d-flex">
                                        <span class="ml-2" style="font-size: 10px;">Class :</span>
                                        <span class="ml-2" style="font-size: 10px;">`+classes+`</span>
                                    </div>
                                    <div class="d-flex">
                                        <span class="ml-2" style="font-size: 10px;">ST_ID :</span>
                                        <span class="ml-2" style="font-size: 10px;">`+st_id+`</span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        `;

                        // particular fee_details 
                        // $.each(feeDetails, function (index, feeDetail) {
                        //     console.log("Fee Type: " + feeDetail.fee_type);
                        //     console.log("Amount: " + feeDetail.amount);
                        //     console.log("Number of Months: " + feeDetail.month);
                        // });

                            // Example: Iterate through commonFeeDetails

                            if(common_fee_particular_tr == ''){
                                var index = 1;
                                for (var feeType in commonFeeDetails) {
                                    if (commonFeeDetails.hasOwnProperty(feeType)) {
                                        var amount = commonFeeDetails[feeType].amount;
                                        var monthCount = commonFeeDetails[feeType].month;
                                        common_fee_particular_tr += `
                                        <tr>
                                            <th scope="row">`+index+`</th>
                                            <td>`+feeType+`</td>
                                            <td>`+monthCount+`</td>
                                            <td>`+amount+`</td>
                                        </tr>
                                        `;
                                     index++;
                                    }
                                }
                                common_fee_particular_tr += `
                                    <tr>
                                        <th scope="row">#</th>
                                        <td colspan='2' class='text-start'>Total Fee</td>
                                        <td>`+response.total_common_amount+`</td>
                                    </tr>
                                `;
                            }

                               console.log(commonFeeDetails);
                               $('.paid_btn').attr('data-fee-particular', JSON.stringify(commonFeeDetails));

                      
                    });

                    // $.each(response.common_fee_details, function (index, feeDetail) {
                    //     alert(feeDetail.fee_type);
                    // });

                    $('.school-name').html(response.school_details.school_name);
                    $('.school-address').html(response.school_details.address);
                    $('.school-logo').attr('src', '../storage/'+response.school_details.logo_img);
 

                    $('.modale-table').html(`
                    <table class="table table-bordered my-1 table-sm text-light" style="font-size:12px;">
                    <thead>
                       <tr>
                          <td colspan="5">
                             <div class="d-flex justify-content-between text-light" style="font-size:13px;">
                                <span>Billing : Up to `+UptoMonth+`</span>
                                <span>Date : 2080-06-01</span>
                             </div>
                          </td>
                       </tr>

                       `+student_tr+`
 
                    <tr class="text-center">
                       <th scope="col">SN.</th>
                       <th scope="col">Particulars</th>
                       <th scope="col">Months</th>
                       <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                     `+common_fee_particular_tr+`
                    </tbody>
                 </table>
                    `);

                  


                } else {
                    console.error("Error: " + response.status);
                }
        

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
        });

    });
});

// paid final sucess 
$(document).ready(function(){
    $('.paid_btn').click(function(){
        var payMonthArray = [];
        var fee_amount =  $('#fee_input').val();
        var paid_amount =  $('#paid_input').val();
        var disc_amount =  $('#disc_input').val();
        var dues_amount =  $('#dues_input').val();
        var comment_disc = $('#comment_disc').val();
        var pay_date = $('#pay_date').val();
        var fee_year = NepaliFunctions.GetCurrentBsDate().year;
        var all_st_id = $(this).attr('all_st_id');
        var st_id_array = all_st_id.split(',');

 
        var pr_id = $(this).attr('pr_id');
        var dataFeeParticular =  $('.paid_btn').attr('data-fee-particular');


        $('.month-check-input:checked').each(function() {
            payMonthArray.push($(this).val());
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url: "/student-fee-paid",
            method: "POST", 
            data: {
                pay_month_array: payMonthArray,
                fee_year: fee_year,
                fee_amount: fee_amount,
                paid_amount: paid_amount,
                disc_amount: disc_amount,
                dues_amount: dues_amount,
                comment_disc: comment_disc,
                pay_date: pay_date,
                data_fee_particular: dataFeeParticular,
                st_id_array: st_id_array,
                pr_id: pr_id,
            },
            success: function (response) {

                console.log(response);
               if(response.status == 'success'){
                $('.payment-model-colose').click();
                $("#search-btn").click();

                Swal.fire({
                    title: 'Payment Success!',
                    text: "Do you want to print the bill?",
                    icon: 'success',
                    confirmButtonColor: '#00032e',
                    confirmButtonText: 'OK',
                  });

               }

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
          });

    });
});

// Paid Oninput Condition  
$(document).ready(function () {
    $("#paid_input").on("input", function (e) {
        var ActualDues = Number($("#fee_input").val());
        var discount = Number($("#disc_input").val());
        var payment = Number($(this).val());
        
        if (payment < 0) {
            $(this).val(0);
            payment = 0; // Update payment value
        }

        if (ActualDues < payment) {
            $("#paid_input").val(ActualDues);
            $("#percentage").val(0);
            $("#disc_input").val(0);
            $("#comment_for_discount").addClass("d-none");
            payment = ActualDues; // Update payment value
        }

        // Calculate and update dues
        var newDues = ActualDues - payment;
        $("#dues_input").val(newDues - discount);

    });

    $("input[type='number']").on("keypress", function (e) {
        if (e.key === "+" || e.key === "-" || e.key === "e") {
            e.preventDefault();
        }
    });
});

// Saving Oninput Condition
$(document).ready(function () {
    $("#disc_input").on("input", function (e) {
    
      var ActualDues = Number($("#fee_input").val());
      var discount = Number($("#disc_input").val());
    
      var AfterDiscuntPay = ActualDues - discount;
      $("#paid_input").val(AfterDiscuntPay);
    
        if(discount <= 0){
          $("#paid_input").val(ActualDues);
          $("#percentage").val(0);
          $(this).val(0);
          return false;
        }
    
        var percentage = (discount / ActualDues * 100).toFixed(3);
        $("#percentage").val(percentage);
    
        if(discount >= ActualDues){
          $(this).val(ActualDues);
          $("#percentage").val(100);
          $("#paid_input").val(0);
        }
    
    });
    
      $("input[type='number']").on("keypress", function (e) {
          if (e.key === "+" || e.key === "-" || e.key === "e" || e.key === ".") {
              e.preventDefault();
          }
      });
});

$(document).ready(function(){
 
    $("#disc_input,#percentage").on("input",function()
    {  
        if ($(this).val()) {
            // Check if there are leading zeros followed by non-zero digits and remove them
            let inputValue = $(this).val().replace(/^0+(?=[1-9])/, '');
        
            // Set the value to '100' if it's empty
            $(this).val(inputValue || 100);
        }
    });
  });

// Percentage Oninput Condition
$(document).ready(function(){
    $("#percentage").on("input", function(e){
        var percentage = $(this).val();
        var ActualDues = Number($("#fee_input").val());
  
          if(percentage < 0){
            $(this).val(0);
            return false;
          }
  
          if(percentage > 100){
            $(this).val(100);
            $("#paid_input").val(0);
            $("#disc_input").val(ActualDues);
            return false;
          }
  
          var discountAmount  = ActualDues / 100 * percentage;
            
          $("#disc_input").val(discountAmount);
  
          $("#paid_input").val(ActualDues - discountAmount);
          
    })
});

  // Discount Comment input display 
  $(document).ready(function () {
    $('#percentage, #disc_input').on('input', function () {
      var percentage = $('#disc_input').val();
      $("#dues_input").val(0);
  
        if(percentage > 0){
          $("#comment_for_discount").removeClass("d-none");
        }
  
        if(percentage <= 0){
          $("#comment_for_discount").addClass("d-none");
        }
    });
  });

  $(document).ready(function () {
    $('#percentage').on('keydown', function (e) {
      if (e.keyCode === 190 || e.keyCode === 110) {
        e.preventDefault();
      }
    });
  });
  
    //  Selected student get fee months 
    $(document).ready(function(){
        $(".students-table").on("click", ".students", function(){  

            var st_id = $(this).attr('st_id');

            $.ajax({
                url: "/student-fee-retrive",
                method: 'GET',
                data:{
                    st_id:st_id
                },
                // Success 
                success:function(response)
                {
                console.log(response);

                if(response.status == 'success'){
                    $('.students-fee-table').html('');
                    response.fee_month.forEach((element, index) => {

                        $('.students-fee-table').append(`
                            <tr class='text-center'>
                                <td>`+NepaliFunctions.GetBsMonth(index)+`</td>
                                <td>₹ `+element+`</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td><button class="bg-danger border-0 text-light rounded px-4 btn">unpaid</button></td>
                                <td><button class="bg-info take-pay border-0 text-light btn rounded p-2 px-4" style="cursor:pointer">Payment</button></td>
                                <td>
                                    <div class="form-check justify-content-center d-flex">
                                    <input type="checkbox" class="form-check-input" id="check_${index}">
                                    <label class="form-check-label" for="check_${index}" style="cursor:pointer;"></label>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                }
                
                },
                error: function (xhr, status, error) 
                {
                    // console.log(xhr.status);
                    $('.students-fee-table').html('');
                    if(xhr.status == 404){
                        $('.students-fee-table').append(`
                            <tr>
                                <td colspan='8' class='py-3 px-3'><span>No fee structures set this student</sapn></td>
                            </tr>
                        `);
                    }
                    console.log(xhr.responseText);
                },
            });

        });
    });







 