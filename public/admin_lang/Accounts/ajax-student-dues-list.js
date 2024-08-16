// Retrive Dues List 
$(document).ready(function(){
    $("#search-btn, #done").click(function(){

            // Get all checkboxes except the first one
            var checkboxes = $('.check-box');
            var checkedBoxes = checkboxes.filter(':checked');
            var numChecked = checkedBoxes.length;
            var select_class =  $("#class-select").val();
            var select_section =  $(".section-select").val();

            $(".studnt-table").html(``);
            $(".print-section").html(``);

            if(numChecked != "0")
            {
                ///////// Start Select Month Set ////////
                    var MonthArry = {
                        "1": "Baishakh",
                        "2": "Jestha",
                        "3": "Ashadh",
                        "4": "Shrawan",
                        "5": "Bhadau",
                        "6": "Asoj",
                        "7": "Kartik",
                        "8": "Mangsir",
                        "9": "Poush",
                        "10": "Magh",
                        "11": "Falgun",
                        "12": "Chaitra"
                    };
                    
                    var checkedValues = [];
                    
                    $(".check-box").each(function() {
                        if ($(this).prop('checked')) {
                        checkedValues.push($(this).val());
                        }
                    });
                    
                    if (checkedValues.length > 0) {
                        var firstCheckedKey = checkedValues[0];
                        var lastCheckedKey = checkedValues[checkedValues.length - 1];
                        var firstCheckedMonth = MonthArry[firstCheckedKey];
                        var lastCheckedMonth = MonthArry[lastCheckedKey];

                        var SelectedMonth = firstCheckedMonth + " To " + lastCheckedMonth;
                        $("#selected-month").html(SelectedMonth);

                        $('.tabel-header-show').html('Students Dues '+current_year+' '+SelectedMonth);
                    }
                ///////// End Select Month Set ////////

                if(select_class != "")
                {
                    const SelectMonth = [];
                    $(".check-box").each(function() {
                        if ($(this).prop("checked")) {
                            SelectMonth.push($(this).val());
                        } 
                      });
 
                      $.ajax({
                        url: "/student-fee-dues-list",
                        method: 'GET',
                        data:{
                        select_class:select_class,
                        select_section:select_section,
                        selectmonth:JSON.stringify(SelectMonth),
                        current_year:current_year,
                        },
                        beforeSend: function() 
                        {
                         // setting a timeout
                          $(".loading-th").removeClass("d-none");

                          $(".studnt-table").html(`
                          <th colspan="10" class="border">
                                <center class="d-flex justify-content-center">
                                    <span>Loading </span>
                                    <span class="px-3">
                                        <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                                    </span>
                                </center>
                            </th>
                            `);

                        },
                        beforeSend: function() 
                        {
                            $('.student-dues-table').html('');
                            $('.student-dues-table').append(`
                            <tr>
                                <td colspan='7' class='p-3'>
                                   <div class='d-flex flex-column'>
                                        <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                                        <span>Loading</span>
                                   </div>
                                </td>
                            </tr>
                        `);

                        },
                        success:function(response)
                        {

                            console.log(response);

                            $('.student-dues-table').html('');
                            var sum_total_dues = 0;
                            response.data.forEach(element => {
                                var child = Object.keys(element.fee_details.original.data).length;
                                var total_dues = element.fee_details.original.total_common_amount;
                                sum_total_dues += total_dues;

                                var common_back_year_dues = element.fee_details.original.common_back_year_dues;

                                var SchoolDetails = element.fee_details.original.school_details;
                                var school_name = SchoolDetails.school_name;
                                var address = SchoolDetails.address;
                                var email = SchoolDetails.email;
                                var estd_year = SchoolDetails.estd_year;
                                var phone = SchoolDetails.phone;
                                var pan_no = SchoolDetails.pan_no;

                                //  Students 
                                var students = '';
                                var bill_students = '';
                                for (let key in element.fee_details.original.data) {
    
                                    var student_name = element.fee_details.original.data[key].student_details.student_name;
                                    var classes = element.fee_details.original.data[key].student_details.class;
                                    var section = element.fee_details.original.data[key].student_details.section;


                                    students += student_name+`</br>`;
                                    bill_students +=  '<div style="margin-bottom: 5px;"><b>Student:</b> <span id="st_name">'+student_name+' '+classes+'</span></div>';
                                }
 
                                // Particular 
                                var particular_tr = '';
                                let sn = 0;
                                for (let key in element.fee_details.original.common_fee_details) {
                                    sn++;
                                    // Accessing each fee detail
                                    const feeDetail = element.fee_details.original.common_fee_details[key];
    
                                    // Accessing month and amount properties
                                    const month = feeDetail.month;
                                    const amount = feeDetail.amount;
             
                                particular_tr += `
                                    <tr style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                        <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+sn+`</td>
                                        <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+key+`</td>
                                        <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+month+`</td>
                                        <th style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-totalfee">`+amount+`</th>
                                    </tr>
                                `;

                                }
                            
                            
                                $('.student-dues-table').append(`
                                    <tr>
                                        <td>${element.id}</td>
                                        <td></td>
                                        <td>${students}</td>
                                        <td>${classes+' '+section}</td>
                                        <td>₹ ${removeTrailingZeros(common_back_year_dues)}</td>
                                        <td>₹ ${removeTrailingZeros(total_dues)}</td>
                                        <td>${element.parent_name}</td>
                                        <td>${element.parent_contact}</td>
                                        <td class="d-flex flex-column align-items-center">
                                            <span onclick="window.open('tel:`+element.parent_contact+`');" visitorbtn="btn" btnName="Call Now" class="material-symbols-outlined ml-3 border p-2 animate__animated animate__swing animate__slow animate__delay-1s animate__repeat-2" style="font-size:17px;border-radius:100px;cursor:pointer;">call</span>
                                            <span style="font-size:8px;">Call Now</span>
                                        </td>
                                    </tr>
                                `);

                                // Dues Bil Print 
                                $(".print-section").append(`

                                <div class="bill-box" id="my-element" style="background:white; width: 	148mm; height: 210mm;  overflow: hidden; ">
                                <div style="width: 100%; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
                                    <img src="/storage/invoice-bg.jpg"  style="display:none;width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
                                    
                                    <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                                        <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
                                           <img id="school_logo" src="/storage/upload_assets/school/school_logo.png" style="height:50px; margin: 15px; border:1px solid #f0f1f3;">
                                        </div>
                                        <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                                            <h3 style="margin-top: 20px; font-weight: bolder;">INVOICE</h3>
                                        </div>
                                    </div>
                                    
                                        <div style="width: 100%;">
                                            <center id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                                                `+school_name+`
                                            </center>
                                            <address>
                                            <center><strong style="margin: 10px;" id="school_address">`+address+`</strong></center>
                                            <center><strong style="margin: 20px;" id="estd_year">Estd : `+estd_year+`</strong></center>
                                            <center><strong style="font-size: 13px;margin: 10px;" id="school_contact">Tel :  `+phone+`</strong></center>
                                            </address>
                                        </div>
                                    
                        
                                        <div style="border: 0px solid black; display: flex; margin: 10px;">
                        
                                        <div style="height: 100px; width: 70%; border: 0px solid black; display: flex;">
                            
                                            <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;line-height: 18px;"> 
                                                <div style="margin-bottom: 5px;"><b>Parent:</b> <span id="st_name">${element.parent_name}</span></div>
                                                `+bill_students+`
                                            </div>
                                        </div>
                                
                                        <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display: flex; flex-direction: column; align-items: start;line-height: 18px;">
                                            <div style="margin-bottom: 5px;"><b>Date:</b> <span id="bill-date">`+current_date+`</span></div>
                                            <span style="margin-bottom: 5px;"><b>Pan No: </b>`+pan_no+`</span>
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
                        
                                        
                                        <div><b>Months : </b> <span>up to  ${lastCheckedMonth}</span></div>
                                        <div class="bill-particular-data" id="bill-particular-data">
                                            `+particular_tr+`
                                        </div>
                        
                                        </table>
                        
                                        <center>
                                            <div style="width:290px; margin-left:12px; margin-top:20px;">
                                            
                   
                                                <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                                                    <b>Total Dues :</b>
                                                    <b style="margin-left:100px;">₹ ${removeTrailingZeros(total_dues)}</b>
                                                </div>
                                            </div>
                                        </center>
                        
                        
                                        <div style="margin-top:20px;">
                                            <b>Amount in words :</b>
                                            <span>ertret</span><br>
                                        </div>
                        
                                        <div style="margin-top:10px;">
                                            <b>Notice :</b>
                                            <span>noticed</span><br>
                                        </div>
                        
                        
                                    </div>
                                
                        
                        
                        
                        
                                    <div style="position: absolute; bottom:20px; height: 50px;width: 100%; display:flex; justify-content:center; align-items:center; ">
                                        <span style="text-align:center;font-size:12px;">Thank you for your prompt payment. <br> Your support enables us to continue providing quality education.</span>
                                    </div>
                        
                        
                                </div> 
                            </div>  
                                `);
                       



                            });
                            $('.student-dues-table').append(`
                            <tr>
                                <th colspan="4"><center>Total</center></th>
                                <th>0</th>
                                <th class="totaldues">${sum_total_dues}</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                            </tr>
                        `);
      
                           
                        },
                        error: function (xhr, status, error) 
                        {
                            console.log(xhr.responseText);
                        },
                    });
                }
                else{
                    alert("Please Select Class");
                    $(".studnt-table").html(``); 
                    $(".studnt-table").append(`
                    <th colspan="7" class="border"><center>Please Select Class</center></th>
                 `);
                    
                }
            }
            else{
                $(".studnt-table").html(``); 
                $(".studnt-table").append(`
                   <th colspan="7" class="border"><center>Please Select Months</center></th>
                `);
                $(".total-row").addClass("d-none");
            }
    });
});

// On change Search Click 
$(document).ready(function(){
   $(".section-select").on("change", function(){
       if($(this).val() != "" && $(".section-select").val() != ""){
          $("#search-btn").click();
       }
   })

   $("#order_by").on("change", function(){
        if($("#class-selec").val() != "" && $(".section-select").val() != ""){
            $("#search-btn").click();
        }
   })

});

// Months Select  
$(document).ready(function(){
 
    $("#dropdone-selecter").click(function(){
        $(".month-option-box").toggle();
    });

    $("#done").click(function(){
        $(".month-option-box").toggle();
    });

    ///////// Start Select Month Set ////////
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
      
      var checkedValues = [];
      
      $(".check-box").each(function() {
        if ($(this).prop('checked')) {
          checkedValues.push($(this).val());
        }
      });
      
      if (checkedValues.length > 0) {
        var firstCheckedKey = checkedValues[0];
        var lastCheckedKey = checkedValues[checkedValues.length - 1];
        var firstCheckedMonth = MonthArry[firstCheckedKey];
        var lastCheckedMonth = MonthArry[lastCheckedKey];

        var SelectedMonth = firstCheckedMonth + " To " + lastCheckedMonth;
        $("#selected-month").html(SelectedMonth);
      }
      ///////// End Select Month Set ////////
});

 

// checkbox Condition auto select 
$(document).ready(function() {
 
    for (var i = 0; i <= current_month; i++) {
         $('input[value="'+i+'"]').click();
    }

    $('.check-box').on('click', function() {
        var clickedIndex = $('.check-box').index(this);

        $('.check-box').each(function(index) {
            if (index < clickedIndex) {
                $(this).prop('checked', true);
            } else if (index > clickedIndex) {
                $(this).prop('checked', false);
            }
        });
    });
});


// Notice 
$(document).ready(function(){
    $("#notice-input").on("input",function(){
       var notice = $(this).val();
       localStorage.setItem('notice', notice);
    });

    if (localStorage.getItem('notice')) {

        var noticeValue = localStorage.getItem('notice');
        $("#notice-input").val(noticeValue);
    }
    // else{
    //     $("#notice-input").val("If the payment is not made before the exam, the student will not be able to take the exam, please pay immediately."); 
    // }


});


 




 