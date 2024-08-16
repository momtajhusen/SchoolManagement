// Date wize Collection Report 
$(document).ready(function() {
    $("#searchDate").click(function() {
        var from_date = $(".from-date").val();
        var to_date = $(".to-date").val();

        // Start Valid Date Check 
        if (!NepaliFunctions.ValidateBsDate(from_date)) {
            alert("Invalid from_date Date!");
            return false;
        }

        if (!NepaliFunctions.ValidateBsDate(to_date)) {
            alert("Invalid to_date Date!");
            return false;
        }
        // End Valid Date Check 

        $.ajax({
            url: "/get-collection-date-wize",
            method: "GET",
            data: {
                from_date: from_date,
                to_date: to_date,
            },
            beforeSend: function() {
                $(".payment-history-date").html('');
                $(".payment-history-date").append(`
                    <tr>
                       <th colspan='12' class='text-center'>Loading <i class="fa fa-circle-o-notch fa-spin" style="font-size:13px"></i></th>
                    </tr> 
                `);
            },
            success: function(response) {
                console.log(response);

                // Clear existing content
                $(".payment-history-date").html('');

                // Check if paymentHistoryData exists and has data
                if (response.paymentHistoryData && response.paymentHistoryData.length > 0) {
                    var count = 0;
                    var totalPayment = 0;
                    var length = response.paymentHistoryData.length;

                    response.paymentHistoryData.forEach(function(data, index) {
                        var sn = length - index; // Serial number in reverse order
                        var payment = data.payment;
                        var id = data.id;
                        var discount = data.discount;
                        var dues = data.dues;
                        var free_fee = data.free_fee;
                        var pay_date = data.pay_date;
                        var pay_month = data.pay_month;
                        var class_year = data.class_year;
                        var st_id = data.student_id;
                        var first_name = data.first_name;
                        var last_name = data.last_name;
                        var father_name = data.father_name;
                        var classes = data.class;
                        var section = data.section;
                        var processed_by = data.processed_by || ''; // Using || for default empty string

                        var student_name = first_name + ' ' + last_name;

                        totalPayment += parseInt(payment);

                        var updated_at = data.updated_at;
                        var updatedAtDate = new Date(updated_at);
                        var pay_time = updatedAtDate.toLocaleTimeString();

                        var MonthArry = {
                            "month_0": "Baishakh",
                            "month_1": "Jestha",
                            "month_2": "Ashadh",
                            "month_3": "Shrawan",
                            "month_4": "Bhadau",
                            "month_5": "Asoj",
                            "month_6": "Kartik",
                            "month_7": "Mangsir",
                            "month_8": "Poush",
                            "month_9": "Magh",
                            "month_10": "Falgun",
                            "month_11": "Chaitra"
                        };
                        
                        var months;        
                        if (pay_month !== 'Previus Year') {
                            if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) {
                                var pay_month_array = JSON.parse(pay_month);
                                var month_length = pay_month_array.length;
                                var firstMonth = MonthArry[pay_month_array[0]];
                                var lastMonth = MonthArry[pay_month_array[month_length - 1]];
                                months = `${firstMonth} to ${lastMonth}`;
                            } else {
                                months = MonthArry[pay_month];
                            }
                        } else {
                            months = "Prev year " + class_year;
                        }

                        $(".payment-history-date").append(`
                            <tr>
                                <td nowrap="nowrap">${sn}</td>
                                <td nowrap="nowrap">${id}</td>
                                <td nowrap="nowrap">₹ ${parseInt(payment)}</td>
                                <td nowrap="nowrap">₹ ${dues}</td>
                                <td nowrap="nowrap">${months}</td>
                                <td nowrap="nowrap">${processed_by}</td>
                                <td nowrap="nowrap">${st_id}</td>
                                <td nowrap="nowrap">${classes} ${section}</td>
                                <td nowrap="nowrap">${student_name}</td>
                                <td nowrap="nowrap">${father_name}</td>
                                <td nowrap="nowrap">${pay_date}</td>
                                <td nowrap="nowrap">${pay_time}</td>
                            </tr> 
                        `);
                    });

                    $(".payment-history-date").append(`
                        <tr>
                            <th colspan='2' nowrap="nowrap">Total :</th>
                            <th nowrap="nowrap" id="total-month-wize">₹ ${totalPayment}</th>
                        </tr> 
                    `);

                    $(".collection").html(totalPayment.toLocaleString('en-IN'));
                } else {
                    // Display message for no payment history
                    $(".payment-history-date").html('');
                    $(".payment-history-date").append(`
                        <tr>
                            <th colspan='12' class='text-center'>No Payment History</th>
                        </tr> 
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    window.onload = function() {
        $("#searchDate").click();
    };

    $(".dateinput").on("input", function() {
        var inputDate = $(this).val();
        if (NepaliFunctions.ValidateBsDate(inputDate)) {
            $("#searchDate").click();
        }
    });
});

// Get Monthly Fee Generate 
$(document).ready(function(){
 
    $.ajax({
        url: "/get-monthlyfee-generate",
        method: "GET",
        data: {
            year:current_year,
            month:current_month,
            day:current_day,
        },
        success: function (response) {

            console.log(response);

            for (var i = 1; i <= 12; i++) 
            {
 
                var Months = NepaliFunctions.GetBsMonths()[i - 1];
            
                $("#GenerateFeebox").append(`
                    <div class="col-6 col-md-6">
                        <div class="my-2 mr-1 monthBox">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="material-symbols-outlined">calendar_month</span> 
                                    <b>`+Months+`</b>
                                </div>
                                <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                            </div>
                            <div class="d-flex mt-2">
                                <span class="material-symbols-outlined">currency_rupee</span>
                                <span class="month_12">
                                25,21,139</span>
                            </div>
                        </div>
                    </div>
                `);  
            }            
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },

    });
});

// Student wize Collection Report 
$(document).ready(function(){
    $("#searchStudent").click(function(){
       var student_id = $(".student-id").val();
       var from_date = $(".from-date-student").val();
       var to_date = $(".to-date-student").val();

       if(student_id ==  ''){
         alert('enter id or name');
         return false;
       }

       $(".payment-history-date").html('');

        $.ajax({
            url: "/get-collection-student-wize",
            method: "GET",
            data: {
                student_id:student_id,
                from_date:from_date,
                to_date:to_date,
            },
            success: function (response) {
                console.log(response);
 
                if(response.paymentHistoryData)
                {
                    var count = 0;
                    var totalPayment = 0;
                    var length = response.paymentHistoryData.length;
                    response.paymentHistoryData.forEach(function()
                    {
                        var sn = length--;

                        var increase = count++;
                        var payment = response.paymentHistoryData[increase].payment;
                        var id = response.paymentHistoryData[increase].id;
                        var discount = response.paymentHistoryData[increase].discount;
                        var dues = response.paymentHistoryData[increase].dues;
                        var free_fee = response.paymentHistoryData[increase].free_fee;
                        var pay_date = response.paymentHistoryData[increase].pay_date;
                        var pay_month = response.paymentHistoryData[increase].pay_month;
                        var class_year = response.paymentHistoryData[increase].class_year;
                        var pay_month = response.paymentHistoryData[increase].pay_month;
                        var st_id = response.paymentHistoryData[increase].student_id;
                        var first_name = response.paymentHistoryData[increase].first_name;
                        var last_name = response.paymentHistoryData[increase].last_name;
                        var father_name = response.paymentHistoryData[increase].father_name;
                        var classes = response.paymentHistoryData[increase].class;
                        var section = response.paymentHistoryData[increase].section;
                        var processed_by = response.paymentHistoryData[increase].processed_by ?? '';




                        var student_name = first_name+' '+last_name;


                        totalPayment += parseInt(payment);

                        var updated_at = response.paymentHistoryData[increase].updated_at;
                        var updatedAtDate = new Date(updated_at);
                        var pay_time = updatedAtDate.toLocaleTimeString();


                        var MonthArry = {
                            "month_0": "Baishakh",
                            "month_1": "Jestha",
                            "month_2": "Ashadh",
                            "month_3": "Shrawan",
                            "month_4": "Bhadau",
                            "month_5": "Asoj",
                            "month_6": "Kartik",
                            "month_7": "Mangsir",
                            "month_8": "Poush",
                            "month_9": "Magh",
                            "month_10": "Falgun",
                            "month_11": "Chaitra"
                        };


                        if(pay_month != 'Previus Year')
                        {
                        if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) 
                        {
                            var pay_month_array = JSON.parse(pay_month);
                            var month_lenghth = pay_month_array.length;
                            var firstMonth = MonthArry[pay_month_array[0]];
                            var lastMonth = MonthArry[pay_month_array[month_lenghth-1]];
                            var months = `${firstMonth} to ${lastMonth}`;
                        } 
                        else{
                            var months = MonthArry[pay_month];
                        }
                        }

                        else{
                        var months = "Prev year "+response.paymentHistoryData[increase].class_year;
                        }

                            $(".payment-history-date").append(`
                            <tr>
                            <td  nowrap="nowrap">`+sn+`</td>
                            <td  nowrap="nowrap">`+id+`</td>
                            <td  nowrap="nowrap">₹ `+parseInt(payment)+`</td>
                            <td  nowrap="nowrap">₹ `+dues+`</td>
                            <td  nowrap="nowrap">`+months+`</td>
                            <td  nowrap="nowrap">`+processed_by+`</td>
                            <td  nowrap="nowrap">`+st_id+`</td>
                            <td  nowrap="nowrap">`+classes+' '+section+`</td>
                            <td  nowrap="nowrap">`+student_name+`</td>
                            <td  nowrap="nowrap">`+father_name+`</td>
                            <td  nowrap="nowrap">`+pay_date+`</td>
                            <td  nowrap="nowrap">`+pay_time+`</td>
                        </tr> 
                        `);
                                        

                    });

                    $(".payment-history-date").append(`
                        <tr>
                        <th colspan='2'>Total :</th>
                        <th id="total-month-wize">₹ `+totalPayment+`</th>
                        </tr> 
                    `);

                    $(".collection").html(totalPayment.toLocaleString('en-IN'));
                }
            },
            error: function (xhr, status, error) 
            {
              console.log(xhr.responseText);
            },
        });

    });
});

// Hostel Deposit 
$(document).ready(function(){
    $('#depositsearchDate').click(function(){
        var deposit_from_date = $(".deposit-from-date").val();
        var deposit_to_date = $(".deposit-to-date").val();
 
        if(!NepaliFunctions.ValidateBsDate(deposit_from_date)){
         alert("Invalid from_date Date !");
         return false;
         }
 
         if(!NepaliFunctions.ValidateBsDate(deposit_to_date)){
             alert("Invalid to_date Date !");
             return false;
         }
 
         $(".hostel-deposit").html('');

         $.ajax({
            url: "/get-hostel-deposit",
            method: "GET",
            data: {
                deposit_from_date:deposit_from_date,
                deposit_to_date:deposit_to_date,
            },
            success: function (response) {
                console.log(response);

                if(response.HostelDepositData){

                    var length = response.HostelDepositData.length;

                    var totalDeposit = 0;
                    response.HostelDepositData.forEach(element => {

                        var sn = length--;

                        totalDeposit += element.load_amount;

                        $(".hostel-deposit").append(`
                            <tr>
                                <td>${sn}</td>
                                <td>${element.father_name}</td>
                                <td>₹ ${element.load_amount}</td>
                                <td>${element.load_for}</td>
                                <td>${element.date}</td>
                            </tr>
                        `);
                    });


                    $(".hostel-deposit").append(`
                        <tr>
                            <th nowrap="nowrap">#</th>
                            <th nowrap="nowrap">Total Deposit ₹ :</th>
                            <th nowrap="nowrap">₹ `+totalDeposit+`</th>
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
    setTimeout(function(){
        $('#depositsearchDate').click();
    },1000);
});
 
$(document).ready(function(){
    $('#home-tab, #datewize-tab, #studentwize-tab').click(function(){
        $('.payment-history').html('');
    });
});

//  Select Option 
$(document).ready(function(){

    $('.select-colection').on('change', function(){
         var select = $(this).val();
         if(select == 'today'){
            $('.from-date').val(current_date);
            $('.to-date').val(current_date);
            $('#searchDate').click();
         }

         if(select == 'month'){
            var from_date = current_year+'-'+current_month+'-1';
            var end_date = current_year+'-'+current_month+'-'+NepaliFunctions.GetDaysInBsMonth(current_year, current_month);

            $('.from-date').val(from_date);
            $('.to-date').val(end_date);
            $('#searchDate').click();
         }

         if(select == 'year'){
            var from_date = current_year+'-'+'1'+'-1';
            var end_date = current_year+'-'+'12'+'-'+NepaliFunctions.GetDaysInBsMonth(current_year, 12);

            $('.from-date').val(from_date);
            $('.to-date').val(end_date);
            $('#searchDate').click();
         }

         if (!isNaN(select)) {
             var from_date = current_year+'-'+select+'-1';
             var end_date = current_year+'-'+select+'-'+NepaliFunctions.GetDaysInBsMonth(current_year, select);
 
             $('.from-date').val(from_date);
             $('.to-date').val(end_date);
             $('#searchDate').click();
         }

    });
});