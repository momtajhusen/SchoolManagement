// On change Month, Year and Today 
// $(document).ready(function(){
//     $(".select-colection").on("change",function(){

//       var collection_option =  $(this).val();

//       var optionText = $(this).find('option:selected').text();
//       $(".collection-day").html(optionText);
 
//       $(".payment-history").html('');
 
//         $.ajax({
//             url: "/get-new-collection-history",
//             method: "GET",
//             data: {
//                 year:current_year,
//                 month:current_month,
//                 day:current_day,
//                 collection_option: collection_option,
//             },
//             success: function (response) {

//                 console.log(response);
 

//             if(response.paymentHistoryData)
//             {
//                 var count = 0;
//                 var totalPayment = 0;
//                 var length = response.paymentHistoryData.length;
//                 response.paymentHistoryData.forEach(function()
//                 {

//                     var sn = length--;

//                     var increase = count++;
//                     var payment = response.paymentHistoryData[increase].paid;
//                     var discount = response.paymentHistoryData[increase].discount;
//                     var free_fee = response.paymentHistoryData[increase].free_fee;
//                     var pay_date = response.paymentHistoryData[increase].pay_date;
//                     var pay_month = response.paymentHistoryData[increase].pay_month;
//                     var class_year = response.paymentHistoryData[increase].class_year;
//                     var pay_month = response.paymentHistoryData[increase].pay_month;
//                     var st_id = response.paymentHistoryData[increase].student_id;
//                     var student_name = response.paymentHistoryData[increase].student_name;
//                     var father_name = response.paymentHistoryData[increase].father_name;
//                     var mother_name = response.paymentHistoryData[increase].mother_name;
//                     var pr_id = response.paymentHistoryData[increase].pr_id;

//                     var classes = response.paymentHistoryData[increase].class;
//                     var section = response.paymentHistoryData[increase].section;

 

//                     totalPayment += parseInt(payment);

//                     var updated_at = response.paymentHistoryData[increase].updated_at;
//                     var updatedAtDate = new Date(updated_at);
//                     var pay_time = updatedAtDate.toLocaleTimeString();


//                     var MonthArry = {
//                         "month_0": "Baishakh",
//                         "month_1": "Jestha",
//                         "month_2": "Ashadh",
//                         "month_3": "Shrawan",
//                         "month_4": "Bhadau",
//                         "month_5": "Asoj",
//                         "month_6": "Kartik",
//                         "month_7": "Mangsir",
//                         "month_8": "Poush",
//                         "month_9": "Magh",
//                         "month_10": "Falgun",
//                         "month_11": "Chaitra"
//                       };


//                     if(pay_month != 'Previus Year')
//                     {
//                       if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) 
//                       {
//                         var pay_month_array = JSON.parse(pay_month);
//                         var month_lenghth = pay_month_array.length;
//                         var firstMonth = MonthArry[pay_month_array[0]];
//                         var lastMonth = MonthArry[pay_month_array[month_lenghth-1]];
//                         var months = `${firstMonth} to ${lastMonth}`;
//                       } 
//                       else{
//                           var months = MonthArry[pay_month];
//                       }
//                     }

//                     else{
//                       var months = "Prev year "+response.paymentHistoryData[increase].class_year;
//                     }
 
//                         $(".payment-history").append(`
//                         <tr>
//                         <td scope="row">`+sn+`</td>
//                           <td nowrap="nowrap">₹ `+parseInt(payment)+`</td>
//                           <td nowrap="nowrap">`+student_name+`</td>
//                           <td nowrap="nowrap">father: ${father_name}<br>mother: ${mother_name}</td>
//                           <td nowrap="nowrap">`+pr_id+`</td>
//                           <td nowrap="nowrap" style="width:100px">`+pay_date+`</td>
//                         </tr> 
//                     `);               

//                 });

//                 $(".payment-history").append(`
//                     <tr>
//                     <th>₹ :</th>
//                     <th id="total-month-wize">`+totalPayment+`</th>
//                     </tr> 
//                 `);

//                 $(".total-collection").html(totalPayment.toLocaleString('en-IN'));
//             }



//             },
//             error: function (xhr, status, error) 
//             {
//                 console.log(xhr.responseText);
//             },

//         });
      
//     });

//     $.ajax({
//         url: "/get-new-collection-history",
//         method: "GET",
//         data: {
//             year:current_year,
//             month:current_month,
//             day:current_day,
//             collection_option:  "today",
//         },
//         success: function (response) {

//             console.log(response);



//             if(response.paymentHistoryData)
//                 {
//                     var count = 0;
//                     var totalPayment = 0;
//                     var length = response.paymentHistoryData.length;
//                     response.paymentHistoryData.forEach(function()
//                     {
    
//                         var sn = length--;
    
//                         var increase = count++;
//                         var payment = response.paymentHistoryData[increase].paid;
//                         var discount = response.paymentHistoryData[increase].discount;
//                         var free_fee = response.paymentHistoryData[increase].free_fee;
//                         var pay_date = response.paymentHistoryData[increase].pay_date;
//                         var pay_month = response.paymentHistoryData[increase].pay_month;
//                         var class_year = response.paymentHistoryData[increase].class_year;
//                         var pay_month = response.paymentHistoryData[increase].pay_month;
//                         var st_id = response.paymentHistoryData[increase].student_id;
//                         var student_name = response.paymentHistoryData[increase].student_name;
//                         var father_name = response.paymentHistoryData[increase].father_name;
//                         var mother_name = response.paymentHistoryData[increase].mother_name;
//                         var pr_id = response.paymentHistoryData[increase].pr_id;
    
//                         var classes = response.paymentHistoryData[increase].class;
//                         var section = response.paymentHistoryData[increase].section;
    
     
    
//                         totalPayment += parseInt(payment);
    
//                         var updated_at = response.paymentHistoryData[increase].updated_at;
//                         var updatedAtDate = new Date(updated_at);
//                         var pay_time = updatedAtDate.toLocaleTimeString();
    
    
//                         var MonthArry = {
//                             "month_0": "Baishakh",
//                             "month_1": "Jestha",
//                             "month_2": "Ashadh",
//                             "month_3": "Shrawan",
//                             "month_4": "Bhadau",
//                             "month_5": "Asoj",
//                             "month_6": "Kartik",
//                             "month_7": "Mangsir",
//                             "month_8": "Poush",
//                             "month_9": "Magh",
//                             "month_10": "Falgun",
//                             "month_11": "Chaitra"
//                           };
    
    
//                         if(pay_month != 'Previus Year')
//                         {
//                           if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) 
//                           {
//                             var pay_month_array = JSON.parse(pay_month);
//                             var month_lenghth = pay_month_array.length;
//                             var firstMonth = MonthArry[pay_month_array[0]];
//                             var lastMonth = MonthArry[pay_month_array[month_lenghth-1]];
//                             var months = `${firstMonth} to ${lastMonth}`;
//                           } 
//                           else{
//                               var months = MonthArry[pay_month];
//                           }
//                         }
    
//                         else{
//                           var months = "Prev year "+response.paymentHistoryData[increase].class_year;
//                         }
     
//                             $(".payment-history").append(`
//                             <tr>
//                             <td scope="row">`+sn+`</td>
//                               <td nowrap="nowrap">₹ `+parseInt(payment)+`</td>
//                               <td nowrap="nowrap">`+student_name+`</td>
//                               <td nowrap="nowrap">father: ${father_name}<br>mother: ${mother_name}</td>
//                               <td nowrap="nowrap">`+pr_id+`</td>
//                               <td nowrap="nowrap" style="width:100px">`+pay_date+`</td>
//                             </tr> 
//                         `);               
    
//                     });
    
//                     $(".payment-history").append(`
//                         <tr>
//                         <th>₹ :</th>
//                         <th id="total-month-wize">`+totalPayment+`</th>
//                         </tr> 
//                     `);
    
//                     $(".total-collection").html(totalPayment.toLocaleString('en-IN'));
//                 }

            
//             for (var i = 1; i <= 12; i++) {
//                 var month_name = NepaliFunctions.GetBsMonth(i-1);
//                 var month = "month_"+i;

//                 var generateAmount = response.GenerateMonthsAmount[month];
//                 var paymentMounthsAmount = response.PaymentMounthsAmount[month];
//                 var paymentHistoryAmount = Number(response.PaymentHistoryAmount[month]);
//                 var hostelDeposite = Number(response.HostelDeposite[month]);


//                 var TotalCollection = paymentHistoryAmount;


//                 var GenerateMonthsAmount = generateAmount.toLocaleString('en-IN');
//                 var PaymentMounthsAmount = paymentMounthsAmount.toLocaleString('en-IN');
//                 var paymentHistoryAmount = paymentHistoryAmount.toLocaleString('en-IN');

//                 var TotalCollection = TotalCollection.toLocaleString('en-IN');

        


//                 $("#monthsBox").append(`
//                     <div class="col-6 col-md-4">
//                         <div class="my-2 mx-1 monthBox">
//                             <div>
//                                 <div class="d-flex align-items-center justify-content-between">
//                                     <div class="d-flex">
//                                         <span class="material-symbols-outlined">calendar_month</span> 
//                                         <b>`+month_name+`</b>
//                                     </div>
//                                     <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
//                                 </div>
//                                 <div class="d-flex flex-column mt-2">
//                                     <div class="d-flex text-info">
//                                         <span class="material-symbols-outlined">currency_rupee</span>
//                                         <span class="month_1">`+GenerateMonthsAmount+`</span>
//                                     </div>
//                                     <div class="d-flex text-secondary">
//                                         <span class="material-symbols-outlined">currency_rupee</span>
//                                         <span class="month_1">`+PaymentMounthsAmount+`</span>
//                                     </div>
 
//                                     <div class="d-flex text-success">
//                                         <span class="material-symbols-outlined">currency_rupee</span>
//                                         <span class="month_1">`+TotalCollection+`</span>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 `);  
//             }

//         },
//         error: function (xhr, status, error) 
//         {
//             console.log(xhr.responseText);
//         },

//     });
 
// });

// Date wize Collection Report 
$(document).ready(function(){
    $("#searchDate").click(function(){
       var from_date = $(".from-date").val();
       var to_date = $(".to-date").val();

       if(!NepaliFunctions.ValidateBsDate(from_date)){
        alert("Invalid from_date Date !");
        return false;
        }

        if(!NepaliFunctions.ValidateBsDate(to_date)){
            alert("Invalid to_date Date !");
            return false;
        }

       $.ajax({
        url: "/get-new-collection-date-wize",
        method: "GET",
        data: {
            from_date:from_date,
            to_date:to_date,
        },
        beforeSend: function() {
            $(".payment-history-date").html('');
            $(".payment-history-date").append(`
                <tr>
                    <th colspan='12' class='text-center'>Loading <i class="fa fa-circle-o-notch fa-spin" style="font-size:13px"></i></th>
                </tr> 
            `);
        },
        success: function (response) {

            console.log(response);

        // Clear existing content
        $(".payment-history-date").html('');


            // alert(response);
            // return false;

            if(response.paymentHistoryData)
            {
                var count = 0;
                var totalPayment = 0;
                var length = response.paymentHistoryData.length;
                response.paymentHistoryData.forEach(function()
                {

                    var sn = length--;

                    var increase = count++;
                    var payment = response.paymentHistoryData[increase].paid;
                    var discount = response.paymentHistoryData[increase].discount;
                    var free_fee = response.paymentHistoryData[increase].free_fee;
                    var pay_date = response.paymentHistoryData[increase].pay_date;
                    var pay_month = response.paymentHistoryData[increase].pay_month;
                    var class_year = response.paymentHistoryData[increase].class_year;
                    var pay_month = response.paymentHistoryData[increase].pay_month;
                    var st_id = response.paymentHistoryData[increase].student_id;
                    var student_name = response.paymentHistoryData[increase].student_name;
                    var father_name = response.paymentHistoryData[increase].father_name;
                    var mother_name = response.paymentHistoryData[increase].mother_name;
                    var pr_id = response.paymentHistoryData[increase].pr_id;

                    var classes = response.paymentHistoryData[increase].class;
                    var section = response.paymentHistoryData[increase].section;

 

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
                        <td scope="row">`+sn+`</td>
                          <td nowrap="nowrap">₹ `+parseInt(payment)+`</td>
                          <td nowrap="nowrap">`+student_name+`</td>
                          <td nowrap="nowrap">father: ${father_name}<br>mother: ${mother_name}</td>
                          <td nowrap="nowrap">`+pr_id+`</td>
                          <td nowrap="nowrap" style="width:100px">`+pay_date+`</td>
                        </tr> 
                    `);               

                });

                $(".payment-history-date").append(`
                    <tr>
                    <th>₹ :</th>
                    <th id="total-month-wize">`+totalPayment+`</th>
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
        error: function (xhr, status, error) 
        {
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


// Student wize Collection Report 
$(document).ready(function(){
    $("#searchStudent").click(function(){
       var parents_id = $(".parents-id").val();
       var from_date = $(".from-date-student").val();
       var to_date = $(".to-date-student").val();

       if(parents_id ==  ''){
         alert('enter id or name');
         return false;
       }

       $(".payment-history-date").html('');

        $.ajax({
            url: "/get-new-collection-student-wize",
            method: "GET",
            data: {
                parents_id:parents_id,
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
                            var payment = response.paymentHistoryData[increase].paid;
                            var discount = response.paymentHistoryData[increase].discount;
                            var free_fee = response.paymentHistoryData[increase].free_fee;
                            var pay_date = response.paymentHistoryData[increase].pay_date;
                            var pay_month = response.paymentHistoryData[increase].pay_month;
                            var class_year = response.paymentHistoryData[increase].class_year;
                            var pay_month = response.paymentHistoryData[increase].pay_month;
                            var st_id = response.paymentHistoryData[increase].student_id;
                            var student_name = response.paymentHistoryData[increase].student_name;
                            var father_name = response.paymentHistoryData[increase].father_name;
                            var mother_name = response.paymentHistoryData[increase].mother_name;
                            var pr_id = response.paymentHistoryData[increase].pr_id;
        
                            var classes = response.paymentHistoryData[increase].class;
                            var section = response.paymentHistoryData[increase].section;
        
         
        
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
         
                                $(".payment-history").append(`
                                <tr>
                                <td scope="row">`+sn+`</td>
                                  <td nowrap="nowrap">₹ `+parseInt(payment)+`</td>
                                  <td nowrap="nowrap">`+student_name+`</td>
                                  <td nowrap="nowrap">father: ${father_name}<br>mother: ${mother_name}</td>
                                  <td nowrap="nowrap">`+pr_id+`</td>
                                  <td nowrap="nowrap" style="width:100px">`+pay_date+`</td>
                                </tr> 
                            `);               
        
                        });
        
                        $(".payment-history").append(`
                            <tr>
                            <th>₹ :</th>
                            <th id="total-month-wize">`+totalPayment+`</th>
                            </tr> 
                        `);
        
                        $(".total-collection").html(totalPayment.toLocaleString('en-IN'));
                    }
        
            },
            error: function (xhr, status, error) 
            {
              console.log(xhr.responseText);
            },
        });

    });
});
 
 $(document).ready(function(){
    $('#home-tab, #datewize-tab, #studentwize').click(function(){
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

