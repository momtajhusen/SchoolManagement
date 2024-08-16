//  Search icon 
$(document).ready(function(){
    $(".parent-search-icon").click(function(){
        $(".parent-details-box").addClass('d-none');
        $(".student-search-box").removeClass('d-none');
        $(".students-table").html(''); 
        $('.mult-total-row').addClass('d-none');
        $('.parent-update-btn').addClass('d-none');
        $('.student-month-fee').html('');
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
      studentFeeYearRequest(pr_id);

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

    var select_fee_year = $('.select-student-fee').val();

    $('.select-fee-year-component').attr('pr_id', pr_id);
 
    $.ajax({
        url: "/parent-student-retrive",
        method: 'GET',
        data:{
            pr_id:pr_id,
            selectedMonth: selectedMonth,
            current_year:select_fee_year,
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
            var mother_name = response.parent_details.mother_name;
            var father_name = response.parent_details.father_name;

            var father_contact = response.parent_details.father_mobile;

            var village = response.student_details[0].village ?? '';
 
            $('.pr-id').val(pr_id);
            $('.parent-image').attr('src','../storage/'+father_img+'');
            $('.mother-name').val(mother_name);
            $('.father-name').val(father_name);
            $('.father-contact').val(father_contact);
            $('.father-address').val(village);

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
                                    <img class="border p-1 parent-image hover-image-preview" src="/storage/`+element.student_image+`" alt="parent" style="width:40px;" />
                                    <div class='ml-2' style='line-height:18px;'>
                                        <div class='d-flex'>
                                          <input class='student-name-input' value='${student_name}'>
                                          <input type='submit' class='save-student-btn d-none' value='save'>
                                        </div>
                                        <div style='font-size:12px;'>
                                            <span>cls: `+classes+`</span>
                                            <span class='ml-2'>id: <span class='st_id'>`+element.id+`</span></span>
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

                $('.parent-profile-btn').html(`
                    <span class="material-symbols-outlined" style="font-size:18px;">person</span>
                   <a href="/admin/parent-profile/${pr_id}">Parent Profile</a>
                `);
 


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
                        $('.check_month_' + i+ ' input').prop('checked', false);
                       
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

            var multi_month_paid_0 = 0;
            var multi_month_paid_1 = 0;
            var multi_month_paid_2 = 0;
            var multi_month_paid_3 = 0;
            var multi_month_paid_4 = 0;
            var multi_month_paid_5 = 0;
            var multi_month_paid_6 = 0;
            var multi_month_paid_7 = 0;
            var multi_month_paid_8 = 0;
            var multi_month_paid_9 = 0;
            var multi_month_paid_10 = 0;
            var multi_month_paid_11 = 0;

            var multi_month_disc_0 = 0;
            var multi_month_disc_1 = 0;
            var multi_month_disc_2 = 0;
            var multi_month_disc_3 = 0;
            var multi_month_disc_4 = 0;
            var multi_month_disc_5 = 0;
            var multi_month_disc_6 = 0;
            var multi_month_disc_7 = 0;
            var multi_month_disc_8 = 0;
            var multi_month_disc_9 = 0;
            var multi_month_disc_10 = 0;
            var multi_month_disc_11 = 0;

            var session_multi_fee_1 = 0;
            var session_multi_fee_2 = 0;
            var session_multi_fee_3 = 0;
            var session_multi_fee_4 = 0;

            var session_multi_paid_1 = 0;
            var session_multi_paid_2 = 0;
            var session_multi_paid_3 = 0;
            var session_multi_paid_4 = 0;

            var session_multi_disc_1 = 0;
            var session_multi_disc_2 = 0;
            var session_multi_disc_3 = 0;
            var session_multi_disc_4 = 0;

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

                    multi_month_paid_0 += Number(data.paid_month_0);
                    multi_month_paid_1 += Number(data.paid_month_1);
                    multi_month_paid_2 += Number(data.paid_month_2);
                    multi_month_paid_3 += Number(data.paid_month_3);
                    multi_month_paid_4 += Number(data.paid_month_4);
                    multi_month_paid_5 += Number(data.paid_month_5);
                    multi_month_paid_6 += Number(data.paid_month_6);
                    multi_month_paid_7 += Number(data.paid_month_7);
                    multi_month_paid_8 += Number(data.paid_month_8);
                    multi_month_paid_9 += Number(data.paid_month_9);
                    multi_month_paid_10 += Number(data.paid_month_10);
                    multi_month_paid_11 += Number(data.paid_month_11);

                    multi_month_disc_0 += Number(data.disc_month_0);
                    multi_month_disc_1 += Number(data.disc_month_1);
                    multi_month_disc_2 += Number(data.disc_month_2);
                    multi_month_disc_3 += Number(data.disc_month_3);
                    multi_month_disc_4 += Number(data.disc_month_4);
                    multi_month_disc_5 += Number(data.disc_month_5);
                    multi_month_disc_6 += Number(data.disc_month_6);
                    multi_month_disc_7 += Number(data.disc_month_7);
                    multi_month_disc_8 += Number(data.disc_month_8);
                    multi_month_disc_9 += Number(data.disc_month_9);
                    multi_month_disc_10 += Number(data.disc_month_10);
                    multi_month_disc_11 += Number(data.disc_month_11);

                     var session_fee_1 = Number(data.month_0) + Number(data.month_1) + Number(data.month_2);
                     var session_fee_2 = Number(data.month_3) + Number(data.month_4) + Number(data.month_5);
                     var session_fee_3 = Number(data.month_6) + Number(data.month_7) + Number(data.month_8);
                     var session_fee_4 = Number(data.month_9) + Number(data.month_10) + Number(data.month_11);

                     var session_paid_1 = Number(data.paid_month_0) + Number(data.paid_month_1) + Number(data.paid_month_2);
                     var session_paid_2 = Number(data.paid_month_3) + Number(data.paid_month_4) + Number(data.paid_month_5);
                     var session_paid_3 = Number(data.paid_month_6) + Number(data.paid_month_7) + Number(data.paid_month_8);
                     var session_paid_4 = Number(data.paid_month_9) + Number(data.paid_month_10) + Number(data.paid_month_11);

                     var session_disc_1 = Number(data.disc_month_0) + Number(data.disc_month_1) + Number(data.disc_month_2);
                     var session_disc_2 = Number(data.disc_month_3) + Number(data.disc_month_4) + Number(data.disc_month_5);
                     var session_disc_3 = Number(data.disc_month_6) + Number(data.disc_month_7) + Number(data.disc_month_8);
                     var session_disc_4 = Number(data.disc_month_9) + Number(data.disc_month_10) + Number(data.disc_month_11);

                     session_multi_fee_1 += session_fee_1;
                     session_multi_fee_2 += session_fee_2;
                     session_multi_fee_3 += session_fee_3;
                     session_multi_fee_4 += session_fee_4;

                     session_multi_paid_1 += session_paid_1;
                     session_multi_paid_2 += session_paid_2;
                     session_multi_paid_3 += session_paid_3;
                     session_multi_paid_4 += session_paid_4;

                     session_multi_disc_1 += session_disc_1;
                     session_multi_disc_2 += session_disc_2;
                     session_multi_disc_3 += session_disc_3;
                     session_multi_disc_4 += session_disc_4;

                    $('.student-month-fee').append(`
                    <tr class="bg-secondary text-light" style='font-size: 13px;'>
                        <th scope="row">${index+1}</th>
                        <td nowrap="nowrap">`+data.student_name+`</td>
                        <td nowrap="nowrap">`+data.year+`</td>
                        <td nowrap="nowrap">₹ `+ data.total_fee +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_paid +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_disc +`</td>
                        <td nowrap="nowrap">₹ `+ data.total_dues +`</td>

                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_0}<br>
                            <span class='text-paid'>₹ ${data.paid_month_0}<br>
                            <span class='text-dues'>₹ ${data.month_0-data.paid_month_0-data.disc_month_0}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_1}<br>
                            <span class='text-paid'>₹ ${data.paid_month_1}<br>
                            <span class='text-dues'>₹ ${data.month_1-data.paid_month_1-data.disc_month_1}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_2}<br>
                            <span class='text-paid'>₹ ${data.paid_month_2}<br>
                            <span class='text-dues'>₹ ${data.month_2-data.paid_month_2-data.disc_month_2}</span><br>
                        </td>
                        <td nowrap="nowrap" class='d-none'>
                            <span>₹ ${session_fee_1}<br>
                            <span class='text-paid'>₹ ${session_paid_1}<br>
                            <span class='text-dues'>₹ ${session_fee_1-session_paid_1-session_disc_1}</span><br>
                        </td>
    
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_3}<br>
                            <span class='text-paid'>₹ ${data.paid_month_3}<br>
                            <span class='text-dues'>₹ ${data.month_3-data.paid_month_3-data.disc_month_3}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_4}<br>
                            <span class='text-paid'>₹ ${data.paid_month_4}<br>
                            <span class='text-dues'>₹ ${data.month_4-data.paid_month_4-data.disc_month_4}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_5}<br>
                            <span class='text-paid'>₹ ${data.paid_month_5}<br>
                            <span class='text-dues'>₹ ${data.month_5-data.paid_month_5-data.disc_month_5}</span><br>
                        </td>
                        <td nowrap="nowrap" class='d-none'>
                            <span>₹ ${session_fee_2}<br>
                            <span class='text-paid'>₹ ${session_paid_2}<br>
                            <span class='text-dues'>₹ ${session_fee_2-session_paid_2-session_disc_2}</span><br>
                        </td>


                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_6}<br>
                            <span class='text-paid'>₹ ${data.paid_month_6}<br>
                            <span class='text-dues'>₹ ${data.month_6-data.paid_month_6-data.disc_month_6}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_7}<br>
                            <span class='text-paid'>₹ ${data.paid_month_7}<br>
                            <span class='text-dues'>₹ ${data.month_7-data.paid_month_7-data.disc_month_7}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_8}<br>
                            <span class='text-paid'>₹ ${data.paid_month_8}<br>
                            <span class='text-dues'>₹ ${data.month_8-data.paid_month_8-data.disc_month_8}</span><br>
                        </td>
                        <td nowrap="nowrap" class='d-none'>
                            <span>₹ ${session_fee_3}<br>
                            <span class='text-paid'>₹ ${session_paid_3}<br>
                            <span class='text-dues'>₹ ${session_fee_3-session_paid_3-session_disc_3}</span><br>
                        </td>

                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_9}<br>
                            <span class='text-paid'>₹ ${data.paid_month_9}<br>
                            <span class='text-dues'>₹ ${data.month_9-data.paid_month_9-data.disc_month_9}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_10}<br>
                            <span class='text-paid'>₹ ${data.paid_month_10}<br>
                            <span class='text-dues'>₹ ${data.month_10-data.paid_month_10-data.disc_month_10}</span><br>
                        </td>
                        <td nowrap="nowrap" class='ledger-month'>
                            <span>₹ ${data.month_11}<br>
                            <span class='text-paid'>₹ ${data.paid_month_11}<br>
                            <span class='text-dues'>₹ ${data.month_11-data.paid_month_11-data.disc_month_11}</span><br>
                        </td>
                        <td nowrap="nowrap" class='d-none'>
                            <span>₹ ${session_fee_4}<br>
                            <span class='text-paid'>₹ ${session_paid_4}<br>
                            <span class='text-dues'>₹ ${session_fee_4-session_paid_4-session_disc_4}</span><br>
                        </td>
                `);
                
                
                });
 

                $('.total-student-month-fee').html(`
                <tr class="bg-dark text-light">
                    <td nowrap="nowrap" colspan="3">Total Fee</td>
                    <td nowrap="nowrap">₹ `+ multi_total_fee +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_paid +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_disc +`</td>
                    <td nowrap="nowrap">₹ `+ multi_total_dues +`</td>

                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_0}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_0}</span></br>
                        <span class='text-dues'>₹ ${multi_month_0 - multi_month_paid_0 - multi_month_disc_0}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_1}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_1}</span></br>
                        <span class='text-dues'>₹ ${multi_month_1 - multi_month_paid_1 - multi_month_disc_1}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_2}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_2}</span></br>
                        <span class='text-dues'>₹ ${multi_month_2 - multi_month_paid_2 - multi_month_disc_2}</span>
                    </td>
                    <td nowrap="nowrap" class='d-none'>
                        <span>₹ ${session_multi_fee_1}<br>
                        <span class='text-paid'>₹ ${session_multi_paid_1}<br>
                        <span class='text-dues'>₹ ${session_multi_fee_1-session_multi_paid_1-session_multi_disc_1}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_3}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_3}</span></br>
                        <span class='text-dues'>₹ ${multi_month_3 - multi_month_paid_3 - multi_month_disc_3}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_4}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_4}</span></br>
                        <span class='text-dues'>₹ ${multi_month_4 - multi_month_paid_4 - multi_month_disc_4}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_5}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_5}</span></br>
                        <span class='text-dues'>₹ ${multi_month_5 - multi_month_paid_5 - multi_month_disc_5}</span>
                    </td>
                    <td nowrap="nowrap" class='d-none'>
                        <span>₹ ${session_multi_fee_2}<br>
                        <span class='text-paid'>₹ ${session_multi_paid_2}<br>
                        <span class='text-dues'>₹ ${session_multi_fee_2-session_multi_paid_2-session_multi_disc_2}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_6}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_6}</span></br>
                        <span class='text-dues'>₹ ${multi_month_6 - multi_month_paid_6 - multi_month_disc_6}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_7}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_7}</span></br>
                        <span class='text-dues'>₹ ${multi_month_7- multi_month_paid_7 - multi_month_disc_7}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_8}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_8}</span></br>
                        <span class='text-dues'>₹ ${multi_month_8 - multi_month_paid_8 - multi_month_disc_8}</span>
                    </td>
                    <td nowrap="nowrap" class='d-none'>
                        <span>₹ ${session_multi_fee_3}<br>
                        <span class='text-paid'>₹ ${session_multi_paid_3}<br>
                        <span class='text-dues'>₹ ${session_multi_fee_3-session_multi_paid_3-session_multi_disc_3}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_9}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_9}</span></br>
                        <span class='text-dues'>₹ ${multi_month_9 - multi_month_paid_9 - multi_month_disc_9}</span>
                    </td>
                    <td nowrap="nowrap">
                        <span>₹ ${multi_month_10}</span></br>
                        <span class='text-paid'>₹ ${multi_month_paid_10}</span></br>
                        <span class='text-dues'>₹ ${multi_month_10 - multi_month_paid_10 - multi_month_disc_10}</span>
                    </td>
                    <td nowrap="nowrap">
                    <span>₹ ${multi_month_11}</span></br>
                    <span class='text-paid'>₹ ${multi_month_paid_11}</span></br>
                    <span class='text-dues'>₹ ${multi_month_11 - multi_month_paid_11 - multi_month_disc_11}</span>
                    </td>
                    <td nowrap="nowrap" class='d-none'> 
                        <span>₹ ${session_multi_fee_4}<br>
                        <span class='text-paid'>₹ ${session_multi_paid_4}<br>
                        <span class='text-dues'>₹ ${session_multi_fee_4-session_multi_paid_4-session_multi_disc_4}</span>
                    </td>
                </tr>
               `);

               $('.text-dues').each(function(){
                   var dues_html = $(this).html();

                   if(dues_html == '₹ 0'){
                     $(this).addClass('d-none');
                   }
              });

              $('.text-paid').each(function(){
                var paid_html = $(this).html();

                if(paid_html == '₹ 0'){
                 $(this).addClass('d-none');
               }
             });

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

        //   GetParticular(st_id_array, month_array, select_fee_year, st_id_array, pr_id, UptoMonth);
 

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

        var UptoMonth = MonthsArray[month_array[month_array.length - 1] - 1];


        $('.up-to-month').html('Up to '+UptoMonth);

        var select_fee_year = $('.select-student-fee').val();

        GetParticular(st_id_array, month_array, select_fee_year, st_id_array, pr_id, UptoMonth);



    });
});

function GetParticular(st_id_array, month_array, select_fee_year, pr_id, UptoMonth){

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
            fee_year: select_fee_year,
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
                            <img src="/storage/`+student_img+`" class="border hover-image-preview" alt="" style="width:25px;height:25px;">
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
                            <span>Date :  `+current_date+`</span>
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
}

// paid final sucess 
$(document).ready(function(){
    $('.paid_btn').click(function(){
         

        
        var payMonthArray = [];
        var fee_amount =  $('#fee_input').val();
        var paid_amount =  $('#paid_input').val();
        var disc_amount =  $('#disc_input').val();
        var disc_percent =  $('#percentage').val();

        var dues_amount =  $('#dues_input').val();
        var comment_disc = $('#comment_disc').val();
        var pay_date = $('#pay_date').val();
        var last_month_amount = $("#last_month").val();

        var all_st_id = $(this).attr('all_st_id');
        var st_id_array = all_st_id.split(',');

 
        var pr_id = $(this).attr('pr_id');
        var dataFeeParticular =  $('.paid_btn').attr('data-fee-particular');

        var select_fee_year = $('.select-student-fee').val();
 
        if(disc_percent != 100){
            if(paid_amount == 0){
                alert('you can not paid 0 amount');
                return false;
              }
        }


        if (Number(dues_amount) > Number(last_month_amount)) {
            alert('Dues are higher than last month. Unselect last month.');
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
                fee_year: select_fee_year,
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
            beforeSend: function () {
                // setting a timeout
                $(".paid_btn").addClass("d-none");
            },
            success: function (response) {

                console.log(response);
               if(response.status == 'success'){

                $(".paid_btn").removeClass("d-none");
 
                  Swal.fire({
                    title: 'Payment Success!',
                    text: "Do you want to print the bill?",  
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#00032e',
                    cancelButtonColor: '#00032e',
                    confirmButtonText: 'Bill View !',
                    cancelButtonText: 'No Bill View !',
                  }).then((result) => {
                    if (result.isConfirmed) {

                        bill_view(response.invoice_id);
                        $("#feeInvoiceModal").modal('show');

                    } 
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
 
        var pr_id = $(".pr-id").val();

        var select_student_fee = $('.select-student-fee').val();

 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/student-paid-history",
            method: "GET", 
            data: {
                year: select_student_fee,
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
                                <td nowrap="nowrap">`+element.processed_by+`</td>
                                <td>
                                <button invoice_id=`+element.id+` id='invoice-btn' class='btn btn-block invoice-print-btn border border-primary d-flex align-items-center justify-content-center'>
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
                          <button pr_id='`+pr_id+`' year='`+select_fee_year+`' class='btn reset-all-btn btn-block border border-primary d-flex align-items-center justify-content-center'>
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
        bill_view(invoice_id);
        $("#feeInvoiceModal").modal('show');
        $("#feeInvoiceModal").animate({ scrollTop: 500 }, 2000);
    });
});

function bill_view(invoice_id){



 
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

                $('.payment-reset').attr('invoice_id', invoice_id);

                var commonFeeDetails = response.particular_data;

                var history_id = response.total_fee.history_id;
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

                var UptoFirstMonth = MonthsArray[firstMonthNumber];
                var UptoLastMonth = MonthsArray[lastMonthNumber];

            
                var student_tr = '';
                var fee_particular_tr = '';

                response.students.forEach(element => {
                    var st_id = element.id;
                    var student_name = element.first_name+' '+ element.last_name;
                    var classes = element.class+' '+element.section;
                    var student_img = element.student_image;
                    student_tr += `
                            <div style="width: 100%;display: flex; align-items: center;">
                                 <img src="../storage/`+student_img+`" alt="student" style="width:30px;height:30px;border:1px solid #000000; padding:2px;">
                                 <div style="width: 100%;margin-left:10px; display: flex; flex-direction: column; line-height:20px;">
                                     <b>`+student_name+`</b>
                                     <div style="width: 100%;font-size:12px; display: flex;">
                                         <span>Class: `+classes+`</span>
                                         <span style="margin-left: 20px;">Id: `+st_id+`</span>
                                     </div>
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
                                        <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff; text-align: center;">${index}</td>
                                        <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff; text-align: start;">${feeType}</td>
                                        <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff; text-align: center;">${monthCount}</td>
                                        <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff; text-align: start;">₹ ${removeTrailingZeros(amount)}</td>
                                    </tr>
                        `;
                        index++;
                    }
                }

                var disc_display = disc <= 0 ? 'none' : '';

                $('.school-name').html(response.school_details.school_name);
                $('.school-address').html(response.school_details.address);
                // $('.school-email').html(response.school_details.email);
                $('.school-phone').html('Contact: '+response.school_details.phone);
                $('.school-logo').attr('src', '../storage/'+response.school_details.logo_img);
                $('.school-logo-watermark').attr('src', '../storage/'+response.school_details.logo_img);
                $('.pay_date').html('Date : '+pay_date);
                $('.bill_no').html('Bill No . '+history_id);
                $('.pan_no').html('Pan No : '+response.school_details.pan_no);


                $('.invoice-students').html(student_tr);

                $('.invoice-particular-table').html(`
                        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                             <thead>
                                 <tr>
                                     <th style="width:25px; border: 1px solid #000000; padding: 8px; text-align: left; background-color: #f2f2f2;">SN.</th>
                                     <th style="border: 1px solid #000000; padding: 8px; text-align: left; background-color: #f2f2f2;">Particulars</th>
                                     <th style="width:70px; border: 1px solid #000000; padding: 8px; text-align: left; background-color: #f2f2f2;"> Mon/Qty </th>
                                     <th style="border: 1px solid #000000; padding: 8px; text-align: left; background-color: #f2f2f2;">Amount</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 `+fee_particular_tr+`
                             </tbody>
                             <tfoot>
                                 <tr>
                                     <td colspan="3" style="border: 1px solid #000000; padding: 8px; text-align: right; background-color: #ffffff;">
                                         <div style="display: flex; justify-content: space-between;">
                                             <strong style="font-size: 13px;">Billing :  `+UptoFirstMonth+` to  `+UptoLastMonth+`</strong>
                                             <strong>Total Fee :</strong>
                                         </div>
                                     </td>
                                     <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff;"><strong>₹ `+removeTrailingZeros(fee)+`</strong></td>
                                 </tr>
                                 <tr style="display:`+disc_display+`">
                                     <td colspan="3" style="border-left: 1px solid #000000; padding: 8px; text-align: right; background-color: #ffffff;"><strong>Disc :</strong></td>
                                     <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff;"><strong>₹ `+removeTrailingZeros(disc)+`</strong></td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="border-left: 1px solid #000000; padding: 8px; text-align: right; background-color: #ffffff;"><strong>Paid :</strong></td>
                                     <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff;"><strong>₹ `+removeTrailingZeros(paid)+`</strong></td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="border-left: 1px solid #000000; border-bottom: 1px solid #000000; padding: 8px; text-align: right; background-color: #ffffff;"><strong>Dues :</strong></td>
                                     <td style="border: 1px solid #000000; padding: 8px; background-color: #ffffff;"><strong>₹ `+removeTrailingZeros(dues)+`</strong></td>
                                 </tr>
                             </tfoot>
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
 
}

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
        bill_reset(invoice_id);
    });
    
    $(".payment-reset").click(function()
    {  
        var invoice_id =  $(this).attr('invoice_id');
        bill_reset(invoice_id);
    });
}); 

function bill_reset(invoice_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: 'Are You Sure Reset History?',
        text: " Please note that reset deleting this student will permanently remove this paid hsitory data.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reset it!'
    }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            url: "/student-single-fee-reset",
            method: "POST", 
            data: {
                invoice_id: invoice_id,
            },
            success: function (response) {

                console.log(response);
                if(response.status == 'success'){

                    Swal.fire({
                        title: 'Reset Success!',
                        text: "Paid History Reset",
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

}

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

// Tablle toggle 
$(document).ready(function(){
    $('#table-toggle').click(function(){
        $('.student-month-fee').toggleClass('d-none');

        // Check if the content is 'expand_less', change it to 'expand_more', and vice versa
        var iconContent = $('.expend-icon').html();
        if (iconContent === 'expand_less') {
            $('.expend-icon').html('expand_more');
        } else {
            $('.expend-icon').html('expand_less');
        }
    });
});

// fee year select option on change refresh  
$(document).ready(function(){
     $('.select-student-fee').on('change', function(){
        $('.refresh-icon').click();
     });
});

// Dues Invoice Print 
$(document).ready(function(){
    $('#printDuesInvoice').click(function(){

        var all_st_id = $('.all_student_st').attr('st_id');

        var pr_id = $('.take-pay-multi').attr('pr_id');    
        var st_id_array = all_st_id.split(',');
        var month_array = [];


        $('.month-check-input:checked').each(function() {
            var value = $(this).val();
            var monthNumber = parseInt(value.replace('month_', '')) + 1; // Extract number and add 1
            month_array.push(monthNumber);
        });
 
        var UptoMonth = MonthsArray[month_array[month_array.length - 1] - 1];
    
        $('.up-to-month').html('Up to '+UptoMonth);
    
        var select_fee_year = $('.select-student-fee').val();

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
                fee_year: select_fee_year,
                st_id_array: st_id_array,
                pr_id: pr_id,
            },
            success: function (response) {
    
                console.log(response);

                var father_name = $('.father-name').val();
    
    
                $('#last_month').val(0);
                if (response.status === 'success') {

  
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


                    student_tr += '<div style="margin-bottom: 5px;"><b>Student:</b> <span id="st_name">'+student_name+' '+classes+'</span></div>';

   
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
                                        <td><center>`+monthCount+`</center></td>
                                        <td></center>`+amount+`</center></td>
                                    </tr>
                                    `;
                                 index++;
                                }
                            }
 
                        }
 
                  
                });

                        $("#invoice-box").html(`
                     
                        <div class="bill-box" id="my-element" style="background:white; width: 	148mm; height: 210mm;  overflow: hidden; ">
                        <div style="width: 100%; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
                            <img src="/storage/invoice-bg.jpg"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
                            
                            <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                                <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
                                   <img id="school_logo" src="/storage/upload_assets/school/school_logo.png" style="height:50px; margin: 15px; border:1px solid #f0f1f3;">
                                </div>
                                <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                                    <h3 style="margin-top: 20px; font-weight: bolder;">DUES INVOICE</h3>
                                </div>
                            </div>
                            
                                <div style="width: 100%;">
                                    <center id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                                       ${response.school_details.school_name}
                                    </center>
                                    <address>
                                    <center><strong style="margin: 10px;" id="school_address">${response.school_details.address}</strong></center>
                                    <center><strong style="margin: 20px;" id="estd_year">Estd : ${response.school_details.estd_year}</strong></center>
                                    <center><strong style="font-size: 13px;margin: 10px;" id="school_contact">Tel :  ${response.school_details.phone}</strong></center>
                                    </address>
                                </div>
                            
                
                                <div style="border: 0px solid black; display: flex; margin: 10px;">
                
                                <div style="height: 100px; width: 70%; border: 0px solid black; display: flex;">
                    
                                    <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;line-height: 18px;"> 
                                        <div style="margin-bottom: 5px;"><b>Parent:</b> <span id="st_name">${father_name}</span></div>
                                        `+student_tr+`
                                    </div>
                                </div>
                        
                                <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display: flex; flex-direction: column; align-items: start;line-height: 18px;">
                                    <div style="margin-bottom: 5px;"><b>Date:</b> <span id="bill-date">${current_date}</span></div>
                                    <span style="margin-bottom: 5px;"><b>Pan No: </b>${response.school_details.pan_no}</span>
                                </div>
                                </div>
                        
                            
                                <div class="bill-content" style="padding: 0px;margin: 10px 10px 10px 10px;">
                                <table style="border:1px solid black;font-family: arial, sans-serif;margin-top:15px;border-collapse: collapse;width: 100%;">
                                <tr style="border: 1px solid #000000;text-align: left;padding: 15px;">
                                    <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">SN:</th>
                                    <th style="border-right: 1px solid #747373;padding: 8px;font-size:11px;">Particulars</th>
                                    <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Mo.</th>
                                    <th style="border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Amount</th>
                                </tr>
                
                                
                                <div><b>Months : </b> <span>Up to ${UptoMonth}</span></div>
                                <div class="bill-particular-data" id="bill-particular-data">
                                    `+common_fee_particular_tr+`
                                </div>
                
                                </table>
                
                                <center>
                                    <div style="width:290px; margin-left:12px; margin-top:20px;">
                                    
           
                                        <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                                            <b>Total Dues :</b>
                                            <b style="margin-left:100px;">₹ ${removeTrailingZeros(response.total_common_amount)}</b>
                                        </div>
                                    </div>
                                </center>
                
                
                                <div style="margin-top:20px;">
                                    <b>Amount in words :</b>
                                    <span>${NepaliFunctions.NumberToWords(response.total_common_amount, false)}</span><br>
                                </div>
                
                            </div>
                        
                
                
                
                
                            <div style="position: absolute; bottom:20px; height: 50px;width: 100%; display:flex; justify-content:center; align-items:center; ">
                                <span style="text-align:center;font-size:12px;">Thank you for your prompt payment. <br> Your support enables us to continue providing quality education.</span>
                            </div>
                
                
                        </div> 
                    </div>  `);



                        var content = $('#invoice-box').html();
                        var printWindow = window.open('', '', 'height=800,width=800');
                        var left = (screen.width / 2) - (800 / 2);
                        var top = (screen.height / 2) - (800 / 2);
                        printWindow.moveTo(left, top);
                        printWindow.document.write('<html><head><title>Print</title></head><body>');
                        printWindow.document.write(content);
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                
                        setTimeout(function() {
                            printWindow.print();
                            printWindow.close();
                            $("#bill-modal-cancle").click();
                        }, 500);
                


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

