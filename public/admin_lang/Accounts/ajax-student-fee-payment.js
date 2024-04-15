//  Search icon 
$(document).ready(function(){
    $(".parent-search-icon").click(function(){
        $(".parent-details-box").addClass('d-none');
        $(".student-search-box").removeClass('d-none');
        $(".students-table").html(''); 
        $('.mult-total-row').addClass('d-none');
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

// Refresh Click 
$(document).ready(function(){
    $('.refresh-icon').click(function(){
        $("#search-btn").click();
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
            selectedMonth: selectedMonth,
            current_year:current_year
        },
         // Success 
        success:function(response)
        {

          console.log(response);

          var studentMonthFeeStracture = response.StudentMonthFeeStracture;

          if(response.status == 'success')
          {
            $(".parent-details-box").removeClass('d-none');
            $(".student-search-box").addClass('d-none');
            $('.mult-total-row').removeClass('d-none');

            var pr_id = response.parent_details.id;
            var father_img = response.parent_details.father_image;
            var father_name = response.parent_details.father_name;
            var father_contact = response.parent_details.father_mobile;

            var ward_no = response.student_details[0].ward_no;
            var village = response.student_details[0].village;
            var municipality = response.student_details[0].municipality;

            $('.pr-id').html(pr_id);
            $('.parent-image').attr('src','../storage/'+father_img+'');
            $('.father-name').html(father_name);
            $('.father-contact').html(father_contact);
            $('.father-address').html(village);

            if(response.student_details)
            {
                $(".students-table").html(''); 
                var sum_total_fee = 0;
                var sum_total_paid = 0;
                var sum_total_disc = 0;
                var sum_total_dues = 0;
                var all_st_id = [];

                response.student_details.forEach(element => {
                    var student_name = element.first_name+' '+element.last_name;
                    var classes = element.class+' '+element.section;

                    
                    var total_fee = Math.ceil(element.total_fee);
                    var total_paid = Math.ceil(element.total_paid);
                    var total_disc = Math.ceil(element.total_disc);
                    var total_dues = Math.ceil(element.total_dues);
                    


                    sum_total_fee += element.total_fee;
                    sum_total_paid += element.total_paid;
                    sum_total_disc += element.total_disc;
                    sum_total_dues += element.total_dues;

                    all_st_id.push(element.id);

                    var single_btn = 'd-none';
                    if(element.total_dues != 0){
                        single_btn = '';
                    }



                    $(".students-table").append(`
                    <tr class='students bg-secondary text-light' st_id='`+element.id+`' style='cursor:pointer'>
                        <td>
                            <div class='d-flex justify-content-between'>
                                <div class='d-flex'>
                                    <img class="border p-1 parent-image" src="../storage/`+element.student_image+`" alt="parent" style="width:40px;" />
                                    <div class='ml-2' style='line-height:18px;'>
                                        <span>`+student_name+`</span>
                                        <div style='font-size:12px;'>
                                            <span>cls: `+classes+`</span>
                                            <span class='ml-2'>id: `+element.id+`</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="bg-info `+single_btn+` take-pay-multi border-0 text-light btn rounded py-2 px-3" dues="`+total_dues+`" pr_id='`+pr_id+`' all_st_id="`+element.id+`" data-toggle="modal" data-target="#feePaymentModal" style="cursor:pointer">Single Paid</button>
                            </div>
                        </td>
                        <td class='text-center' nowrap="nowrap">₹ `+total_fee+`</td>
                        <td class='text-center' nowrap="nowrap">₹ `+total_paid+`</td>
                        <td class='text-center' nowrap="nowrap">₹ `+total_disc+`</td>
                        <td class='text-center' nowrap="nowrap">₹ `+total_dues+`</td>
                    </tr>
                `);
                
                });

                $('.total-fee-multi').html(sum_total_fee.toFixed(0));
                $('.total-paid-multi').html(sum_total_paid.toFixed(0));
                $('.total-disc-multi').html(sum_total_disc.toFixed(0));
                $('.total-dues-multi').html(sum_total_dues.toFixed(0));
                
                $(".paid_btn").attr('pr_id', pr_id);
                $('.all_student_st').attr('st_id', all_st_id);



                var multi_paid_btn = 'd-none';
                if(sum_total_dues != 0){
                    multi_paid_btn = '';
                }

                $('.multiple-paid-btn').html(`
                    <button pr_id='`+pr_id+`' class="bg-info `+multi_paid_btn+` take-pay-multi border-0 text-light btn rounded ml-3 py-3 px-4" dues="`+sum_total_dues.toFixed(0)+`" all_st_id="`+all_st_id+`" data-toggle="modal" data-target="#feePaymentModal" style="cursor:pointer">Multi Paid</button>
                `);

                // month status 
                for (var i = 0; i < 12; i++) {
                    var month = 'month_' + i;
                    var month_status = response.month_status[month];
                    
                    if (month_status == "Paid") {
                        // Add bg-success class to the input elements
                        $('.check_month_' + i + ' input').prop("disabled", true);
                        $('.check_month_' + i + ' input').prop("checked", false);
                        $('.check_month_' + i+ ' input').removeClass('bg-dues');
                        $('.check_month_' + i+ ' input').removeClass('bg-feenotset');
                        $('.check_month_' + i+ ' input').addClass('bg-paid');
                        $('.check_month_' + i + ' input').removeClass('month-check-input');
                    }
                    if(month_status == "Dues"){
                        $('.check_month_' + i + ' input').prop("disabled", false);
                        // $('.check_month_' + i + ' input').prop("checked", true);
                        $('.check_month_' + i+ ' input').removeClass('bg-paid');
                        $('.check_month_' + i+ ' input').removeClass('bg-feenotset');
                        $('.check_month_' + i+ ' input').addClass('bg-dues');
                    }
                    if(month_status == "Unpaid"){
                        // Add bg-success class to the input elements
                        $('.check_month_' + i + ' input').prop("disabled", false);
                        $('.check_month_' + i + ' input').addClass('month-check-input');
                        $('.check_month_' + i+ ' input').removeClass('bg-paid');
                        $('.check_month_' + i+ ' input').removeClass('bg-dues');
                        $('.check_month_' + i+ ' input').removeClass('bg-feenotset');
                    }
                    if(month_status == "FeeNotSet"){
                        // Add bg-success class to the input elements
                        $('.check_month_' + i + ' input').prop("disabled", false);
                        $('.check_month_' + i + ' input').addClass('month-check-input');
                        $('.check_month_' + i+ ' input').removeClass('bg-paid');
                        $('.check_month_' + i+ ' input').removeClass('bg-dues');
                        $('.check_month_' + i+ ' input').addClass('bg-feenotset');
                    }
                }
                // month status 

                if(selectedMonth.length == 0){
                    if(response.month_status[month] != 'Paid'){
                     $('.check_month_' + decremented_current_month).find('.month-check-input').click();   
                    }
                }
            }


            // Start Student Fee Month 
            $('.student-month-fee').html('');
            var multi_total_fee = 0;
            var multi_total_paid = 0;
            var multi_total_disc = 0;
            var multi_total_dues = 0;
            var multi_month_0 = 0;
            var multi_month_1 = 0;
            var multi_month_2 = 0;
            var multi_month_3 = 0;
            var multi_month_4 = 0;
            var multi_month_5 = 0;
            var multi_month_6 = 0;
            var multi_month_7 = 0;
            var multi_month_8 = 0;
            var multi_month_9 = 0;
            var multi_month_10 = 0;
            var multi_month_11 = 0;

            if(response.StudentMonthFeeStracture.length != 0){
                var studentMonthFeeStracture = response.StudentMonthFeeStracture;
                studentMonthFeeStracture.forEach(function(data, index) {
                    multi_total_fee += Number(data.total_fee);
                    multi_total_paid += Number(data.total_paid);
                    multi_total_disc += Number(data.total_disc);
                    multi_total_dues += Number(data.total_dues);
                    multi_month_0 += Number(data.month_0);
                    multi_month_1 += Number(data.month_1);
                    multi_month_2 += Number(data.month_2);
                    multi_month_3 += Number(data.month_3);
                    multi_month_4 += Number(data.month_4);
                    multi_month_5 += Number(data.month_5);
                    multi_month_6 += Number(data.month_6);
                    multi_month_7 += Number(data.month_7);
                    multi_month_8 += Number(data.month_8);
                    multi_month_9 += Number(data.month_9);
                    multi_month_10 += Number(data.month_10);
                    multi_month_11 += Number(data.month_11);

 
                    $('.student-month-fee').append(`
                    <tr class="text-center bg-secondary text-light">
                        <th scope="row">1</th>
                        <td nowrap="nowrap">`+data.student_name+`</td>
                        <td nowrap="nowrap">`+data.year+`</td>
                        <td nowrap="nowrap">₹ `+ data.total_fee +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_paid +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_disc +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_dues +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_0 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_1 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_2 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_3 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_4 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_5 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_6 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_7 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_8 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_9 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_10 +`</td>
                        <td nowrap="nowrap">₹ `+ data.month_11 +`</td>
                    </tr>
                `);
                
                });
 

                $('.student-month-fee').append(`
                <tr class="text-center bg-dark text-light">
                    <th scope="row">1</th>
                    <td nowrap="nowrap" colspan="2">Total Fee</td>
                    <td nowrap="nowrap">₹ `+ multi_total_fee +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_paid +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_disc +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_dues +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_0 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_1 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_2 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_3 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_4 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_5 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_6 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_7 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_8 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_9 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_10 +`</td>
                    <td nowrap="nowrap">₹ `+ multi_month_11 +`</td>
                </tr>
            `);
            


            }else{
                $('.student-month-fee').append(`
                <tr class="text-center">
                  <th scope="row"></th>
                  <th scope="row" colspan='17'>Fee Not Set Any Student</th>
                </tr>
            `); 
            }
   
        // End Student Fee Month 

          }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
 }
// End Select parent than retrive stundets 

// Take Paid get particular
$(document).ready(function(){
        $(".students-table, .multiple-paid-btn").on("click", ".take-pay-multi", function()
        {  

        var dues = $(this).attr('dues');
        var all_st_id = $(this).attr('all_st_id');
        var pr_id = $(this).attr('pr_id');

        // alert(pr_id);

        $('#fee_input').val(dues);
        $('#paid_input').val(dues);
        $('#dues_input').val(0);
        $('#disc_input').val(0);
        $('#disc_input').val(0);
        $('#percentage').val(0);

        $('.paid_btn').attr('all_st_id', all_st_id);

        var st_id_array = all_st_id.split(',');
        var month_array = [];
        $('.month-check-input:checked').each(function() {
            var value = $(this).val();
            var monthNumber = parseInt(value.replace('month_', '')) + 1; // Extract number and add 1
            month_array.push(monthNumber);
        });

        var UptoMonth = MonthsArray[month_array.length -1 ];

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
                fee_year: current_year,
                st_id_array: st_id_array,
                pr_id: pr_id,
            },
            success: function (response) {

                console.log(response);

 
                $('#last_month').val(0);
                if (response.status === 'success') {


                    
                    $('.school-name').html(response.school_details.school_name);
                    $('.school-address').html(response.school_details.address);
                    $('.school-logo').attr('src', '../storage/'+response.school_details.logo_img);

                    $('#last_month').val(response.last_month_amount);

                    var data = response.data;
                    var student_tr = '';
                    var common_fee_particular_tr = '';
                    $.each(data, function (studentId, studentData) {
                        var studentDetails = studentData.student_details;
                        var feeDetails = studentData.fee_details;
                        var commonFeeDetails = response.common_fee_details;
                        
            

                        var st_id = studentDetails.id;
                        var student_name = studentDetails.student_name;
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

                               $('.paid_btn').attr('data-fee-particular', JSON.stringify(commonFeeDetails));

                      
                    });
 
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
        var last_month_amount = $("#last_month").val();

        var all_st_id = $(this).attr('all_st_id');
        var st_id_array = all_st_id.split(',');

 
        var pr_id = $(this).attr('pr_id');
        var dataFeeParticular =  $('.paid_btn').attr('data-fee-particular');

        if(dues_amount > last_month_amount){
            alert('Unselect last Month');
            return false;
        }
        


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
                fee_year: current_year,
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
              

                Swal.fire({
                    title: 'Payment Success!',
                    text: "Do you want to print the bill?",
                    icon: 'success',
                    confirmButtonColor: '#00032e',
                    confirmButtonText: 'OK',
                  });
               }

               $('.payment-model-colose').click();
               $('.month-check-input:first').click();

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
          });

    });
});

// Paid History 
$(document).ready(function(){
    $('.history-btn').click(function(){
 
        var pr_id = $(".pr-id").html();
 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/student-paid-history",
            method: "GET", 
            data: {
                year: current_year,
                pr_id: pr_id,
            },
            success: function (response) {

                console.log(response);

                if(response.status == 'success'){
                    $('.paid-history-table').html('');

                    var total_fee = 0;
                    var total_paid = 0;
                    var total_disc = 0;
                    var total_dues = 0;

                    var historyLength = response.data.length;
                    response.data.forEach((element, index) => {
                        var sn = historyLength--;



                        var monthsString = element.pay_month.substring(1, element.pay_month.length - 1);
                        // Splitting the string into an array using comma as the delimiter
                        var monthsArray = monthsString.split(',');
 
                        // Accessing the first and last elements
                        var firstMonthString = monthsArray[0]; // Accessing the first element
                        var lastMonthString = monthsArray[monthsArray.length - 1]; // Accessing the last element

                        // Extracting the number part
                        var firstMonthNumber = parseInt(firstMonthString.match(/\d+/)[0]);
                        var lastMonthNumber = parseInt(lastMonthString.match(/\d+/)[0]);

                        var UptoFirstMonth = MonthsArray[firstMonthNumber].substring(0, 3);
                        var UptoLastMonth = MonthsArray[lastMonthNumber].substring(0, 3);

                        total_fee += Number(element.fee);
                        total_paid += Number(element.paid);
                        total_disc += Number(element.disc);
                        total_dues += Number(element.dues);

                        var resetButtonClass = index != 0 ? 'd-none' : ''; 
 

                    
                         $('.paid-history-table').append(`
                            <tr class="text-center">
                                <th scope="row">`+sn+`</th>
                                <td nowrap="nowrap">`+UptoFirstMonth+` to `+UptoLastMonth+`</td>
                                <td nowrap="nowrap">₹ `+element.paid+`</td>
                                <td nowrap="nowrap">₹ `+element.disc+`</td>
                                <td nowrap="nowrap">₹ `+element.dues+`</td>
                                <td nowrap="nowrap">`+element.pay_date+`</td>
                                <td>
                                <button invoice_id=`+element.id+` class='btn btn-block invoice-print-btn border border-primary d-flex align-items-center justify-content-center' data-toggle="modal" data-target="#feeInvoiceModal" >
                                    <span class="material-symbols-outlined" style='font-size:10px;'>description</span> View
                                </button>
                                </td>
                                <td>
                                <button invoice_id=`+element.id+` class='btn reset-single-btn btn-block border border-primary  `+resetButtonClass+`'>
                                    <span class="material-symbols-outlined" style='font-size:10px;'>restart_alt</span> Reset
                                </button>
                                </td>
                            </tr>
                         `);
                    });
 

                    var paid_disc = total_paid + total_disc;
                    $('.paid-history-table').append(`
                      <tr class="text-center bg-dark text-light">
                        <th scope="row">#</th>
                        <td nowrap="nowrap">Total</td>
                        <td nowrap="nowrap">₹ `+total_paid+`</td>
                        <td nowrap="nowrap">₹ `+total_disc+`</td>
                        <td colspan="2" nowrap="nowrap">(Paid + Disc) ₹ `+paid_disc+`</td>
                        <td nowrap="nowrap"></td>
                        <td nowrap="nowrap">
                          <button pr_id='`+pr_id+`' year='`+current_year+`' class='btn reset-all-btn btn-block border border-primary d-flex align-items-center justify-content-center'>
                           <span class="material-symbols-outlined" style='font-size:10px;'>restart_alt</span> Reset All
                          </button>
                        </td>
                        </tr>
                    `);
                }

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
        });

    });
});

// Fee Invoice View Model Open
$(document).ready(function(){
    $(".paid-history-table").on("click", ".invoice-print-btn", function()
    {  

        var invoice_id = $(this).attr('invoice_id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/student-invoice-data",
            method: "GET", 
            data: {
                invoice_id: invoice_id,
            },
            success: function (response) {

                console.log(response);
 

                if(response.status == 'success'){

                    var commonFeeDetails = response.particular_data;

                    var fee = response.total_fee.fee;
                    var paid = response.total_fee.paid;
                    var disc = response.total_fee.disc;
                    var dues = response.total_fee.dues;
                    var pay_date = response.total_fee.pay_date;

                    var monthsString = response.total_fee.pay_month.substring(1, response.total_fee.pay_month.length - 1);
                    // Splitting the string into an array using comma as the delimiter
                    var monthsArray = monthsString.split(',');

                    // Accessing the first and last elements
                    var firstMonthString = monthsArray[0]; // Accessing the first element
                    var lastMonthString = monthsArray[monthsArray.length - 1]; // Accessing the last element

                    // Extracting the number part
                    var firstMonthNumber = parseInt(firstMonthString.match(/\d+/)[0]);
                    var lastMonthNumber = parseInt(lastMonthString.match(/\d+/)[0]);

                    var UptoFirstMonth = MonthsArray[firstMonthNumber].substring(0, 3);
                    var UptoLastMonth = MonthsArray[lastMonthNumber].substring(0, 3);

                
                    var student_tr = '';
                    var fee_particular_tr = '';

                    response.students.forEach(element => {
                        var st_id = element.id;
                        var student_name = element.first_name+' '+ element.last_name;
                        var classes = element.class+' '+element.section;
                        var student_img = element.student_image;
                        student_tr += `
                        <div class="d-flex justify-content-between p-2 border">
                           <div>
                             <img src="../storage/`+student_img+`" class="border p-1" alt="" style="width:40px;height:40px;">
                             <span class='ml-2'>`+student_name+`</span>
                           </div>
                           <div class='d-flex flex-column' style='font-size:11px;'>
                             <span>Class: `+classes+`</span>
                             <span>ST_ID: `+st_id+`</span>
                           </div>
                        </div>
                    
                        `;
                        
                    });

                    var commonFeeDetails = response.particular_data;
                    var index = 1;
                    var fee_particular_tr = ''; // Initialize the variable to store HTML markup

                    for (var feeType in commonFeeDetails) {
                        if (commonFeeDetails.hasOwnProperty(feeType)) {
                            var amount = commonFeeDetails[feeType].amount;
                            var monthCount = commonFeeDetails[feeType].month;
                            fee_particular_tr += `
                                <tr>
                                    <th scope="row">${index}</th>
                                    <td>${feeType}</td>
                                    <td>${monthCount}</td>
                                    <td>${amount}</td>
                                </tr>
                            `;
                            index++;
                        }
                    }

                    var disc_display = disc <= 0 ? 'd-none' : '';

                    // Append total fee row
                    fee_particular_tr += `
                        <tr>
                            <th scope="row">#</th>
                            <td colspan='2'>
                             <div class='w-100 d-flex justify-content-end'>Total Fee: </div>
                            </td>
                            <td>`+fee+`</td>
                        </tr>
                        <tr class='`+disc_display+`'>
                            <th scope="row">#</th>
                            <td colspan='2' class='text-start'>
                             <div class='w-100 d-flex justify-content-end'>Disc: </div>
                            </td>
                            <td>`+disc+`</td>
                        </tr>
                        <tr>
                            <th scope="row">#</th>
                            <td colspan='2' class='text-start'>
                             <div class='w-100 d-flex justify-content-end'>Paid: </div>
                            </td>
                            <td>`+paid+`</td>
                        </tr>
                        <tr>
                            <th scope="row">#</th>
                            <td colspan='2' class='text-start'>
                             <div class='w-100 d-flex justify-content-end'>Dues: </div>
                            </td>
                            <td>`+dues+`</td>
                        </tr>
                    `;


                    $('.school-name').html(response.school_details.school_name);
                    $('.school-address').html(response.school_details.address);
                    // $('.school-email').html(response.school_details.email);
                    $('.school-phone').html('Contact: '+response.school_details.phone);
                    $('.school-logo').attr('src', '../storage/'+response.school_details.logo_img);
                    $('.school-logo-watermark').attr('src', '../storage/'+response.school_details.logo_img);

                    $('.invoice-students').html(student_tr);

                    $('.invoice-particular-table').html(`
                        <table class="table table-bordered table-border-dark my-1 table-sm">
                        <thead>
                        <tr>
                            <td colspan="5">
                                <div class="d-flex justify-content-between px-2 py-3">
                                    <span>Billing :  `+UptoFirstMonth+` to  `+UptoLastMonth+`</span>
                                    <span>Date :  `+pay_date+`</span>
                                </div>
                            </td>
                        </tr>
                     
                        <tr class="text-center">
                        <th scope="col">SN.</th>
                        <th scope="col">Particulars</th>
                        <th scope="col">Months</th>
                        <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            `+fee_particular_tr+`
                        </tbody>
                    </table>
                    `);
             
                    for (var i = 0; i < 200; i++) {
                        $('.background-water-mark').append(`
                            <div>`+response.school_details.school_name.substring(0, 17)+`</div>
                        `);
                    }

   
                }

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
        });

    });
});

// All Reset 
$(document).ready(function(){
    $(".paid-history-table").on("click", ".reset-all-btn", function()
    {  
    var pr_id =  $(this).attr('pr_id');
    var year =  $(this).attr('year');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: 'Are You Sure Reset History?',
        text: " Please note that reset deleting this student will permanently remove all paid hsitory data.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reset it!'
    }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            url: "/student-all-fee-reset",
            method: "POST", 
            data: {
                pr_id: pr_id,
                year: year,
            },
            success: function (response) {

                console.log(response);

                if(response.status == 'success'){

                    Swal.fire({
                        title: 'Reset Success!',
                        text: "All Paid History Reset",
                        icon: 'success',
                        confirmButtonColor: '#00032e',
                        confirmButtonText: 'OK',
                    });

                    $("#search-btn").click();
                    $('.history-btn').click();
                }

            },
            
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
        });

        }
    });

    }); 
});

// Single Reset
$(document).ready(function(){
    $(".paid-history-table").on("click", ".reset-single-btn", function()
    {  
        var invoice_id =  $(this).attr('invoice_id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/student-single-fee-reset",
            method: "POST", 
            data: {
                invoice_id: invoice_id,
            },
            success: function (response) {

                console.log(response);
                if(response.status == 'success'){
                    $("#search-btn").click();
                    $('.history-btn').click();
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







