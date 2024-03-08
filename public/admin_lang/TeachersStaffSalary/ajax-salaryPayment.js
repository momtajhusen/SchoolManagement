
// Retrive for Payment 
$(document).ready(function(){
    $(".search-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var attendanceYear = $("#attendance-year").val();
        var teacherSelect = $(".teacher-select").val();

        var teacherName = $(".teacher-select option:selected").text();

        $(".year-notice").html(attendanceYear);
 
        var date = NepaliFunctions.GetCurrentBsDate();
        var CurrentDate = date.year+'-'+date.month+'-'+date.day;

        $("#teacher_name").html(teacherName);

        $(".salary-table").empty();
        $.ajax({
            url: "/admin/get-generate-salary",
            data:{
                teacherSelect:teacherSelect,
                currentdate:CurrentDate,
                attendanceYear:attendanceYear,
            },
            method: "GET",
            success: function (response) {
                console.log(response);

                if (response.Data.length > 0) {

                    var TotalGenSalary = 0;
                    var TotalBonus = 0;
                    var TotalSSF = 0;
                    var TotalSSF = 0;
                    var NetPay = 0;
                    var Paid = 0;
                    var Remaining = 0;
 
                    $(".salary-table").append(``);
                    for (var i = 0; i < response.Data.length; i++) {

                        // var month = response.Data[i].month;
                        var month_no =  response.Data[i].month;
                        var emp_id =  response.Data[i].emp_id;

                        var monthNameNo  = month_no-1;
                        var month = NepaliFunctions.GetBsMonths()[monthNameNo];
                        var periods =  response.Data[i].attendance;
                        var percent =  response.Data[i].percent;
                        var salary =  response.Data[i].salary;
                        var gen_salary =  response.Data[i].gen_salary;
                        var bonus =  response.Data[i].bonus;
                        var epf =  response.Data[i].epf;
                        var net_pay =  response.Data[i].net_pay;
                        var paid =  response.Data[i].paid;
                        var remaining =  response.Data[i].remaining;
 
                        var teacher_image =  response.Data[i].teacher_info.image;
                        var role =  response.Data[i].teacher_info.department_role;

                        TotalGenSalary += Number(gen_salary);
                        TotalBonus += Number(bonus);
                        TotalSSF += Number(epf);
                        NetPay += Number(net_pay);
                        Paid += Number(paid);
                        Remaining += Number(remaining);

                       $("#teacher_role").html(role);
                       $("#teacher_id").html('emp_id :'+emp_id);
                       $("#teacher-image").attr('src', '/storage/' + teacher_image);
                       
                        if(remaining == net_pay){
                            var statusText = "Unpaid";
                            var statusColor = "bg-danger";
                            var payBtn = "";
                            var hisBtn = "d-none";
                          }
                          if(remaining ==  0){
                              var statusText = "Paid";
                              var statusColor = "bg-success";
                              var payBtn = "d-none";
                              var hisBtn = "";
                          }
                          if(net_pay !=  remaining && remaining != 0){
                            var statusText = "Rem.";
                            var statusColor = "bg-warning";
                            var payBtn = "";
                            var hisBtn = "";
                        } 

                        var sn = i+1;
                        $(".salary-table").append(`
                            <tr>
                                <td>`+sn+`</td>
                                <td>`+month+`</td>
                                <td>`+percent+` %</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+salary+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+gen_salary+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+bonus+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+epf+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+net_pay+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+paid+`</td>
                                <td><span class="material-symbols-outlined" style="font-size:15px;">currency_rupee</span>`+remaining+`</td>
                                <td><button class='`+statusColor+` d-flex border-0 text-light rounded px-4'>`+statusText+`</button></td>
                                <td><button tr_id='`+emp_id+`' month='`+month_no+`' teacher='`+teacherName+`' periods='`+periods+`' percent="`+percent+`" salary='`+salary+`' gen_salary='`+gen_salary+`' bonus='`+bonus+`' epf='`+epf+`' net_pay='`+remaining+`' class='`+payBtn+` payment-model-btn bg-info border-0 text-light rounded px-3' data-toggle='modal' data-target='#exampleModalCenter' style='cursor:pointer;'>Payment</button></td>
                                <td scope='row' style='width:10px;'>
                                   <button tr_id='`+emp_id+`' month='`+month_no+`' teacher='`+teacherName+`' class='`+hisBtn+` history-btn border-0 text-light rounded px-4 bg-secondary' data-toggle='modal' data-target='#salaryHistory' style="cursor:pointer;"><span class="material-symbols-outlined" style="font-size:15px;">history</span></button>
                                </td>
                            </td>
                        `);
                    }

                    $(".salary-table").append(`
                        <tr>
                           <td>#</td>
                           <td colspan="3">Total</td>
                           <td>₹ `+TotalGenSalary+`</td>
                           <td>₹ `+TotalBonus+`</td>
                           <td>₹ `+TotalSSF+`</td>
                           <td>₹ `+NetPay+`</td>
                           <td>₹ `+Paid+`</td>
                           <td>₹ `+Remaining+`</td>
                        </tr>
                    `);


                }
                
                 else {
                    // Handle the case when no data is found
                    $('.salary-table').html(`<tr><td colspan='3'>Data not found</td></tr>`);
                }

      
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });

    });
});

// Payment Model Open 
$(document).ready(function(){
    $(".salary-table").on("click", ".payment-model-btn", function () 
    {
        var tr_id = $(this).attr("tr_id");
        var periods = $(this).attr("periods");
        var percent = $(this).attr("percent");
        var salary = $(this).attr("salary");
        var gen_salary = $(this).attr("gen_salary");
        var bonus = $(this).attr("bonus");
        var net_pay = $(this).attr("net_pay");
        var teacherName = $(this).attr("teacher");
        var month = $(this).attr("month");
        var epf = $(this).attr("epf");

        $(".teacher_name").html(teacherName);
        $(".salary").html(salary);
        $(".genSalary").html(gen_salary);
        $(".bonus").html(bonus);
        
        $('input[name="month"]').val(month);
        $('input[name="percent"]').val(percent);
        $('input[name="periods"]').val(periods);
        $('input[name="tr_id"]').val(tr_id);
        $('input[name="salary"]').val(salary);
        $('input[name="generate_salary"]').val(gen_salary);
        $('input[name="bonus"]').val(bonus);
        $('input[name="epf"]').val(epf);

        $('input[name="net_pay"]').val(net_pay);
        $('input[name="payment"]').val(net_pay);

    });
});

// Payment Salary 
$(document).ready(function(){
    $('input[name="payment"]').on('input', function() {
        var payment = $('input[name="payment"]').val();
        var net_pay = $('input[name="net_pay"]').val();
        if(payment > net_pay){
            $('input[name="payment"]').val(net_pay);
        }if(payment <= 0){
            $('input[name="payment"]').val(net_pay);
        }
    });
    
    $(".payment-salary-form").submit(function(e){
        e.preventDefault();

        var payment_date = $('input[name="payment_date"]').val();
        var salary_year = $(".salary-year").val();
        var salary_month = $(".salary-month").val();

        if(!NepaliFunctions.ValidateBsDate(payment_date)){
            alert("Invalid Payment Date !");
            return false;
        }

        var formData = new FormData(this);
        formData.append("salary_year", salary_year);
        formData.append("salary_month", salary_month);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url: "/admin/teacher-salary-payment",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
             // Success 
            success:function(response)
            {
                console.log(response);

               if(response.status == "Payment successfully")
               {
                $('#exampleModalCenter').modal('hide');
                Swal.fire({
                    title: "Payment Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                     $(".search-btn").click();
                  });
               }
               else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                  })
               }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
          });

    });
});

// Mode on change 
$(document).ready(function(){
    $(".pay_mode").on('change', function(){
        var mode = $(this).val();

        if(mode == 'Cash'){
            $('.check_number, .transaction_id').addClass('d-none');
        } else if(mode == 'Check'){
            $('.check_number').removeClass('d-none');
            $('.transaction_id').addClass('d-none');
        } else if(mode == 'Online'){
            $('.check_number').addClass('d-none');
            $('.transaction_id').removeClass('d-none');
        }
    });
});


// History Model Open 
$(document).ready(function(){
    $(".salary-table").on("click", ".history-btn", function () 
    {
        var tr_id = $(this).attr("tr_id");
        var teacherName = $(this).attr("teacher");

        var salary_year = $(".salary-year").val();
        var salary_month = $(this).attr("month");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $(".history-table").html('');
          $.ajax({
            url: "/admin/teacher-salary-paid-history",
            method: 'GET',
            data: {
                tr_id:tr_id,
                salary_year:salary_year,
                salary_month:salary_month
            },
             // Success 
            success:function(response)
            {

               if(response.data)
               {
                // for (var i = 0; i < response.Data.length; i++) {
                    response.data.forEach((item, index) => {
                        var sn = index + 1;
                        var month = item.salary_month - 1;
                        var SalaryMonth = NepaliFunctions.GetBsMonths()[month];
                    
                        // Check if it's the last item in the loop
                        var lastBtnClass = (index === 0) ? 'd-block' : 'd-none';
                    
                        $(".history-table").append(`
                            <tr>
                                <td>` + sn + `</td>
                                <td>` + item.payment_date + `</td>
                                <td>` + SalaryMonth + `</td>
                                <td>` + item.recive_salary + `</td>
                                <td>` + item.remaining + `</td>
                                <td><button id="printSlip" py_id='` + item.py_id + `' hs_id='` + item.id + `' class='history-btn border-0 text-light rounded px-4 bg-secondary' style="cursor:pointer;"><span class="material-symbols-outlined" style="font-size:15px;">print</span></button></td>
                                <td><button py_id='` + item.py_id + `' hs_id='` + item.id + `' class='salary-reset-btn border-0 text-light rounded px-4 bg-secondary ` + lastBtnClass + `' style="cursor:pointer;"><span class="material-symbols-outlined" style="font-size:15px;">restart_alt</span></button></td>
                            </tr>
                        `);
                    });
                    

               }
               else{
                  console.log(response);
                  $(".history-table").html(`<tr><td colspan="10"><div class="text-center">`+response.message+`</div></td></tr>`);
               }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
          });
 
    });
});

// Reset Salary 
$(document).ready(function(){
    $(".history-table").on("click", ".salary-reset-btn", function () 
    {
        var hs_id =$(this).attr("hs_id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url: "/admin/teacher-salary-history-reset",
            method: 'POST',
            data: {
                hs_id:hs_id
            },
             // Success 
            success:function(response)
            {

             console.log(response);

              if(response.status == "Reset Sucess")
              {
                $('#salaryHistory').modal('hide');
                Swal.fire({
                    title: "Reset Sucess !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                     $(".search-btn").click();
                  });
              }
              else{
                console.log(response.status);
              }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
          });
    });
});

// Current Year & Month auto select and search 
$(document).ready(function(){
    var date = NepaliFunctions.GetCurrentBsDate();
    var CurrentYear = date.year;
    var CurrentMonth = date.month-1;

    var MonthArray = NepaliFunctions.GetBsMonths();
 

    $("#attendance-year option").filter(function () {
        return $(this).text() == CurrentYear;
     }).prop("selected", true);

     $("#attendance-month option").filter(function () {
        return $(this).text() == MonthArray[CurrentMonth];
     }).prop("selected", true);

     $(".search-btn").click();
     $("#attendance-year, #attendance-month, .teacher-select").on("change", function(){
        $(".search-btn").click();
     });

});

// Print Salary Slip 
$(document).ready(function() {
    $(".history-table").on("click", "#printSlip", function (){ 

       var hs_id = $(this).attr("hs_id");

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
       });

       $.ajax({
        url: "/admin/print-slip-data",
        method: 'GET',
        data: {
            hs_id:hs_id
        },
         // Success 
        success:function(response)
        {
          console.log(response);

          var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

          if(response.SlipData){
            $("#school_logo").attr('src', currentDomainWithProtocol+'/storage/'+response.SchoolDetails.logo_img);
            $("#school_name").html(response.SchoolDetails.school_name);
            $("#school_address").html(response.SchoolDetails.address);
            $("#estd_year").html(response.SchoolDetails.estd_year);
            $("#school_contact").html(response.SchoolDetails.phone);
            $("#school_contact").html(response.SchoolDetails.phone);
            $("#tr_image").attr('src', currentDomainWithProtocol+'/storage/'+response.Teacher.image);
            $("#tr_name").html(response.Teacher.first_name+' '+response.Teacher.last_name);
            $("#tr_role").html(response.Teacher.department_role);
            $("#bill-date").html(response.SlipData.payment_date);
            $("#slip_no").html(response.SlipData.id);
            $("#pan_no").html(response.SchoolDetails.pan_no);

            var monthNameNo  = response.SlipData.salary_month-1;
            var month = NepaliFunctions.GetBsMonths()[monthNameNo];
            $("#salary_month").html(month);

            $(".Billsalary").html(response.SlipData.salary);
            $(".BillAttendance").html(response.SlipData.percent+' %');
            $(".BillGenSalary").html(response.SlipData.generate_salary);
            $(".BillBonus").html('+ '+response.SlipData.bonus);
            $(".BillEpf").html('- '+response.SlipData.epf);
            $(".BillReciveSalary").html(response.SlipData.recive_salary);
            $(".BillRemaining").html(response.SlipData.remaining);
            // $(".recive_salary_word").html(NepaliFunctions.NumberToWords(response.SlipData.recive_salary)+" Only.");

            var content = $('#slip-box').html();
            var printWindow = window.open('', '_blank', 'height=800,width=800');
            printWindow.document.write('<html><head><title>Print Slip</title></head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
                $("#bill-modal-cancle").click();
            }, 500);
 

          }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
      });

    });
});
 