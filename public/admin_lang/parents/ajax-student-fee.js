
// click border change 
$(document).ready(function(){
    $("#student_box").on("click", ".students", function()
    {
         $('.students').each(function(){
          $(this).css('border', '0px');
         });
         $(this).css('border', '2px solid #042954');
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
                     //  Start Iterate through each fee detail for the month
                     $.each(feeDetails, function(index, fee) {
                        monthHtml += `
                            <div class="border d-flex align-items-center fee_stracture">
                                <input class="px-2 input_fee_name" readonly name='fee[`+month+`]' value="${fee.fee_name}">
                                <span class="pr-3">₹</span>
                                <input type="number" min="0" name='amount[`+month+`]' class="input_fee_amount" value="${fee.amount}">
                                <span class="material-symbols-outlined p-1 border delete_fee" st_id=`+st_id+` month=`+month+` year=`+feeYear+` fee_name="${fee.fee_name}" data-toggle="tooltip" data-placement="bottom" title="Delete This Fee" style="cursor: pointer;">delete</span>
                            </div>`;
                    });
                    
                        monthHtml += `<input class='p-1 px-5 month-fee-save-btn' type="submit" value="save" style='cursor:pointer'>`;
                     //  End Iterate through each fee detail for the month
                    

                    $('#month_feestracture').append(`
                        <div class="d-flex flex-column">
                            <div class="collapse_btn w-100 border p-3 d-flex justify-content-between" data-toggle="collapse" data-target="#collapse`+month+`" aria-expanded="false" aria-controls="collapseExample">
                            <div>
                                <span>`+NepaliFunctions.GetBsMonth(month-1)+` ₹</span>
                                <span>23000</span> 
                            </div>
                            <div class="d-flex">
                                <button class="material-symbols-outlined p-1 border mr-2 add-new-fee" data-toggle="tooltip" data-placement="bottom" title="Add New Fee">add</button>
                                <button class="material-symbols-outlined p-1 border" data-toggle="tooltip" data-placement="bottom" title="Delete This Month">delete</button>
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

    // Get the fee data from input elements
    var feeData = {};
    $(this).each(function(index, element) {
        var feeName = $(element).find('.input_fee_name').val();
        var feeAmount = $(element).find('.input_fee_amount').val();
        alert(feeName);

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
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });
});

$(document).ready(function(){
    $("#month_feestracture").on("click", ".add-new-fee", function(){
       var fee_box = $(this).parent().parent().parent().find('.student-fee-save');
       var length = $(this).parent().parent().parent().find('.fee_stracture').length+1;

       alert(length);

       fee_box.append(`<div class="border d-flex align-items-center fee_stracture">
                    <input class="px-2 input_fee_name" name='fee[`+length+`]' value="Fee Name">
                    <span class="pr-3">₹</span>
                    <input type="number" min="0" name='amount[`+length+`]' class="input_fee_amount" value="0">
                    <span class="material-symbols-outlined p-1 border delete_fee" data-toggle="tooltip" data-placement="bottom" title="Delete This Fee" style="cursor: pointer;">delete</span>
                </div>`);
         
   });
});

    

// Delete Fee 
 $(document).ready(function(){
    $("#month_feestracture").on("click", ".delete_fee", function(){
           // Get the values of st_id, month, and year
    var st_id = $(this).attr('st_id');
    var month = $(this).attr('month');
    var year = $(this).attr('year');
    var fee_name =$(this).attr('fee_name');

    $(this).parent().addClass('deleted-fee-process');


      // Send the AJAX request
      $.ajax({
        url: "/admin/delete-month-fee",
        method: "POST",
        data: {
            st_id: st_id,
            month: month,
            year: year,
            fee_name: fee_name 
        },
        success: function (response) {
            console.log(response);

            if(response.status == 'delete successfully'){
              $('.deleted-fee-process').remove();
            }
        },
        error: function (xhr, status, error) {
            // Error callback function
            console.log(xhr.responseText); // Log the error response in the console
        },
    });



    });
 });






