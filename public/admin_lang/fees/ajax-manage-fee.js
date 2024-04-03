
   //  Retrive Fee Structer aftre class option select
    $(document).ready(function () {

            $(".monthly-fee-table").html('');


            $.ajax({
                url: "/retrive-stracture",
                method: "GET",
                data:{
                    current_year:current_year 
                },
                // Success
                success: function (response) {


                    console.log(response);



                    if(response.FeestractureMonthly){
                        var count = 0;
                        response.FeestractureMonthly.forEach(function (data) {
                            var index = count++;

                            var classes = response.FeestractureMonthly[index].class;

                            $(".monthly-fee-table").append(`
                                <tr>
                                    <th style="width:100px;">
                                       <input class="fee_input" readonly type="text" name="class[]"  value="`+response.FeestractureMonthly[index].class+`">
                                    </th>
                                    <td>
                                      <input class="fee_input `+classes+`" type="number" name="tuition_fee[]"  value="`+response.FeestractureMonthly[index].tuition_fee+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="full_hostel_fee[]"  value="`+response.FeestractureMonthly[index].full_hostel_fee+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="half_hostel_fee[]"  value="`+response.FeestractureMonthly[index].half_hostel_fee+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="computer_fee[]"  value="`+response.FeestractureMonthly[index].computer_fee+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="coaching_fee[]"  value="`+response.FeestractureMonthly[index].coaching_fee+`" >
                                    </td>
                                </tr>
                            `);

                            $(".one-time-fee-table").append(`
                                <tr>
                                    <th style="width:100px;">
                                    <input class="fee_input `+classes+`" readonly type="text" name="class[]"  value="`+response.FeestractureOnetime[index].class+`" >
                                    </th>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="admission_fee[]"  value="`+response.FeestractureOnetime[index].admission_fee+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="annual_charge[]"  value="`+response.FeestractureOnetime[index].annual_charge+`" >
                                    </td>
                                    <td>
                                    <input class="fee_input `+classes+`" type="number" name="saraswati_puja[]"  value="`+response.FeestractureOnetime[index].saraswati_puja+`" >
                                    </td>
                                </tr>
                            `);

                            $(".quarterly-fee-table").append(`
                            <tr>
                                <th style="width:100px;">
                                  <input class="fee_input `+classes+`" readonly type="text" name="class[]"  value="`+response.FeestractureQuarterly[index].class+`" >
                                </th>
                                <td>
                                  <input class="fee_input `+classes+`" type="number" name="exam_fee[]"  value="`+response.FeestractureQuarterly[index].exam_fee+`" >
                                </td>
                            </tr>
                            `);
                        
                            // start disable input payments class
                                var totalsClassPayment = response.TotalsClassPayment;
                                var totalPaymentForClass = totalsClassPayment[classes];

                                if(totalPaymentForClass != 0)
                                {
                                    $("."+classes).css("background-color", "#ccc");
                                    $("."+classes).css("cursor", "not-allowed");
                                    $("."+classes).attr("readonly","readonly");
                                }
                            // end disable input payments class

                        });

                    }



                },


            });
    
    });


    $(document).ready(function () {
        $(".feestracture-form").submit(function (e) {
            e.preventDefault();
    
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            var formData = new FormData(this);
            formData.append("formtype", $(this).attr('feetype'));
    
            $.ajax({
                url: "/feestracture-update",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                // Success
                success: function (response) {
                    console.log(response);
                    alert(response.status);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
        });
    });

    // Joining check if null than manage 
    $(document).ready(function(){
            $("#joining-set").click(function(){
                
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "/joining-set",
                method: "get",
                data:{
                    current_year:current_year, 
                },
                // Success
                success: function (response) {
                    console.log(response);
                    alert(response);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });


            });
    });

    
    
