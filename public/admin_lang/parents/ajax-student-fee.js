
 // click student border change 
$(document).ready(function(){
    $("#student_box").on("click", ".students", function()
    {
         $('.students').each(function(){
          $(this).css('border', '0px');
          $(this).removeClass('selected-sudent');
         });

         $(this).css('border', '2px solid #042954');
         $(this).addClass('selected-sudent');

         var st_id = $(this).attr('st_id');
         $(".add-month").attr('st_id', st_id);
         $(".save-deal-fee").attr('st_id', st_id);

    });
});

// Fee Request 
$(document).ready(function(){
    $("#student_box").on("click", ".students", function()
    {
       var st_id = $(this).attr('st_id');

       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: "/admin/student-fee-starcture-retrive", 
        method: "GET",  
        data: {
            st_id: st_id,
        },
        success: function (response) {
            console.log(response);

            // Assuming the response is structured as described before
                var studentFeeStracture = response.StudentFeeStracture;

                var feeYear = response.student.fee_year;
                var st_id = response.student.st_id;

                $("#month_feestracture").html('');
                $.each(studentFeeStracture, function(month, feeDetails) {

                    var monthHtml = '';
                    var monthfee = 0;
                     //  Start Iterate through each fee detail for the month
                     $.each(feeDetails, function(index, fee) {
                        monthfee += fee.amount;
                        monthHtml += `
                            <div class="border d-flex align-items-center fee_stracture">
                                <input class="px-2 input_fee_name" required name='fee[`+month+`]' value="${fee.fee_name}">
                                <span class="pr-3">₹</span>
                                <input type="number" min="0" required name='amount[`+month+`]' class="input_fee_amount" value="${fee.amount}">
                                <span class="material-symbols-outlined p-1 border delete_fee" fee_id="${fee.id}"  data-toggle="tooltip" data-placement="bottom" title="Delete This Fee" style="cursor: pointer;">delete</span>
                            </div>`;
                    });
                    
                        monthHtml += `<input class='p-1 px-5 month-fee-save-btn' type="submit" value="save" style='cursor:pointer'>`;
                     //  End Iterate through each fee detail for the month
                    

                    $('#month_feestracture').append(`
                        <div class="d-flex flex-column">
                        <div class='d-flex collapse_box'>
                            <div class="collapse_btn w-100 border p-1 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse`+month+`" aria-expanded="false" aria-controls="collapseExample">
                                <div>
                                    <span>`+NepaliFunctions.GetBsMonth(month-1)+` ₹</span>
                                    <span>`+monthfee+`</span> 
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 border">
                              <span class="material-symbols-outlined p-1 border mr-2 add-new-fee" data-toggle="tooltip" data-placement="bottom" title="Add New Fee">add</span>
                              <span class="material-symbols-outlined p-1 border delete-month" st_id=`+st_id+` year=`+feeYear+` month=`+month+` data-toggle="tooltip" data-placement="bottom" title="Delete This Month">delete</span>
                            </div>
                           </div>

                            <div class="collapse" id="collapse`+month+`">
                                <div class="card card-body p-2" style="border: 1px solid #042954;border-radius:0px; !important;">
                                        <form class="student-fee-save row border p-2 m-0" st_id=`+st_id+` month=`+month+` year=`+feeYear+`>
                                        `+monthHtml+`
                                        </form>
                                </div>
                            </div>
                        </div>
                    `);
                });
 
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });

       
    });
});

// Save  Month 
$(document).on('submit', '.student-fee-save', function (e) {
    e.preventDefault();

    // Get the values of st_id, month, and year
    var st_id = $(this).attr('st_id');
    var month = $(this).attr('month');
    var year = $(this).attr('year');

    // Get the fee data from fee structures inside the form
    var feeData = {};
    $(this).find('.fee_stracture').each(function(index, element) {
        var feeName = $(element).find('.input_fee_name').val();
        var feeAmount = $(element).find('.input_fee_amount').val();

        feeData['fee_' + index] = {  // Use index to create unique input names
            fee_name: feeName,
            amount: feeAmount
        };
    });

    // Prepare the data to be sent in the AJAX request
    var requestData = {
        st_id: st_id,
        month: month,
        year: year,
        fees: feeData
    };

    // Send the AJAX request
    $.ajax({
        url: "/admin/student-fee-starcture-save",
        method: "POST",
        data: requestData,
        success: function (response) {
            console.log(response);
            if(response.status == 'Fee structures saved successfully')
            {
                iziToast.success({
                    title: 'Save',
                    message: 'Save Successfully !',
                    position: 'topRight', 
                    timeout: 2000,
                });
                $(".selected-sudent").click();
            }
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });
});

// Add New Fee in Month
$(document).ready(function(){
    $("#month_feestracture").on("click", ".add-new-fee", function(){
        var fee_box = $(this).parent().parent().parent().find('form');
        var length = fee_box.find('.fee_stracture').length + 1;

        var newFee = $(`
            <div class="border d-flex align-items-center fee_stracture" style="position: relative; left: -50%;"> <!-- Initially position it outside the visible area -->
                <input class="px-2 input_fee_name" required name='fee[` + length + `]' value="">
                <span class="pr-3">₹</span>
                <input type="number" min="0" required name='amount[` + length + `]' class="input_fee_amount" value="0">
                <span class="material-symbols-outlined p-1 border delete_fee" data-toggle="tooltip" data-placement="bottom" title="Delete This Fee" style="cursor: pointer;">delete</span>
            </div>
        `);

        fee_box.prepend(newFee); // Use .prepend() to insert at the beginning of the form

        // Animate the entry of the newly added fee structure with sliding effect
        newFee.animate({ left: '0' }, 'slow', function() {
            // Focus on the first input element inside the newly added fee structure
            $(this).find('.input_fee_name').focus();
        });
    });
});

// Add Month 
$(document).ready(function(){
    $(".add-month").click(function(){
      var year = $(".select-year").val();
      var month = $(".add-select-month").val();
      var st_id = $('.add-month').attr('st_id');
      var input_fee_name = $('.input_fee_name').val();
      var input_fee_amount = $('.input_fee_amount').val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      if(st_id != '#'){
        $.ajax({
            url: "/admin/add-month", 
            method: "POST",  
            data: {
                st_id: st_id,
                year: year,
                month:month,
                input_fee_name:input_fee_name,
                input_fee_amount:input_fee_amount,
            },
            success: function (response) {
                console.log(response);
    
                if(response.status == 'add successfully'){
                    iziToast.success({
                        title: 'Month',
                        message: 'Add Successfully !',
                        position: 'topRight', 
                        timeout: 2000,
                    });
                    $(".close-model").click();
                    $(".selected-sudent").click();
                }else{
                    alert(response.status);
                }
     
            },
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            },
        });
    
      }else{
        alert('select student');
      }




    });
});


// Delete Fee 
 $(document).ready(function(){
    $("#month_feestracture").on("click", ".delete_fee", function(){
           // Get the values of st_id, month, and year
 
    var fee_id = $(this).attr('fee_id');
    $(this).parent().addClass('deleted-fee-process');

      // Send the AJAX request
      $.ajax({
        url: "/admin/delete-month-fee",
        method: "POST",
        data: {
            fee_id: fee_id 
        },
        success: function (response) {
            console.log(response);

            if(response.status == 'delete successfully'){
              $('.deleted-fee-process').remove();
              iziToast.success({
                title: 'Fee',
                message: 'Delete Successfully !',
                position: 'topRight', 
                timeout: 2000,
            });
              $(".selected-sudent").click();
            }
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });



    });
 });


 // Delete Month 
 $(document).ready(function(){
    $("#month_feestracture").on("click", ".delete-month", function(){
           // Get the values of st_id, month, and year
 
    var st_id = $(this).attr('st_id');
    var year = $(this).attr('year');
    var month = $(this).attr('month');
 
      // Send the AJAX request
      $.ajax({
        url: "/admin/delete-month",
        method: "POST",
        data: {
            st_id:st_id,
            year: year,
            month: month, 

        },
        success: function (response) {
            console.log(response);

            if(response.status == 'delete successfully'){
                iziToast.success({
                    title: 'Month',
                    message: 'Delete Successfully !',
                    position: 'topRight', 
                    timeout: 2000,
                });
                $(".selected-sudent").click();
            }
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });



    });
 });






