// Retrive Dues List 
$(document).ready(function(){
    $("#search-btn, #done").click(function(){

            // Get all checkboxes except the first one
            var checkboxes = $('.check-box');
            var checkedBoxes = checkboxes.filter(':checked');
            var numChecked = checkedBoxes.length;
            var select_class =  $("#class-select").val();
            var select_section =  $(".section-select").val();

            var current_year = NepaliFunctions.GetCurrentBsDate().year;
            var current_month = NepaliFunctions.GetCurrentBsDate().month;
            var current_day = NepaliFunctions.GetCurrentBsDate().day;

            var current_date = current_year+"-"+current_month+"-"+current_day;

            $(".studnt-table").html(``);
            $(".print-section").html(``);

            if(numChecked != "0")
            {
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
                        success:function(response)
                        {

                            console.log(response);

                            alert(response);
                         

                            return false;

                            var totalfee = 0;
                            var prevBlance = 0;
                            var totalPrevYearDues = 0;
                            var netPay = 0;


                            if(response.data){
                                
                                $(".studnt-table").html(``);
                                $(".loading-th").addClass("d-none");


                                // Sortable 
                                var order_by = $("#order_by").val(); 

                                var orderParts = order_by.split('_');
                                var sortByProperty = orderParts[0]; 
                                var sortOrder = orderParts[1] === 'a' ? 'asc' : 'desc';  
 
                                response.data.sort(function(a, b) {
                                    if (sortOrder === 'asc') {
                                        return a[sortByProperty] - b[sortByProperty];
                                    } else {
                                        return b[sortByProperty] - a[sortByProperty];
                                    }
                                });

                                var count = 0;
                                var index = 1;
                                response.data.forEach(function(){
                                    var increase = count++;
                                    var sn = index++;

                                    // Studenta data 
                                    var id = response.data[increase].id;
                                    var student_image = response.data[increase].student_image;
                                    var first_name = response.data[increase].first_name;
                                    var middle_name = response.data[increase].middle_name;
                                    var last_name = response.data[increase].last_name;
                                    var classes = response.data[increase].class;
                                    var section = response.data[increase].section;
                                    var roll = response.data[increase].roll_no;
                                    var student_phone = response.data[increase].phone;

                                    var studen_name = first_name+" "+middle_name+" "+last_name;

                                    // Parents Data 
                                    var father_name = response.data[increase].ParentsData.father_name;
                                    var mother_name = response.data[increase].ParentsData.mother_name;
                                    var father_mobile = response.data[increase].ParentsData.father_mobile;
                                    var mother_mobile = response.data[increase].ParentsData.mother_mobile;

                                    // Contact 
                                    var parentName = "";
                                    if(father_name != ""){
                                      parentName = father_name;
                                    }
                                    else{
                                      parentName = mother_name;  
                                    }
                                    
                                    var parentContact = "";
                                    if(father_mobile != ""){
                                        parentContact = father_mobile;
                                    }
                                    else{
                                        if(mother_mobile != ""){
                                            var parentContact = mother_mobile;
                                        }
                                        else{
                                            var parentContact = student_phone;
                                        }
                                    }

                                    // Fee Data 
                                    var totalFeesForStudent = response.data[increase].totalFeesForStudent;
                                    var totalPaymentForStudent = response.data[increase].totalPaymentFee;
                                    var totalDiscountForStudent = response.data[increase].totalDiscountfee;
                                    var totalFreeFeeForStudent = response.data[increase].totalFeeFree;
                                    var duesForStudent =  Math.abs(totalPaymentForStudent + totalFreeFeeForStudent + totalDiscountForStudent - totalFeesForStudent);
                                    var BackYearDues = response.data[increase].BackYearFee;
                                    var prevBlanc = response.data[increase].PreviusBlance;
                                    var NetPayable = response.data[increase].NetPay;

                                    if(NetPayable != "0")
                                    {
                                       var dues_message = father_mobile;
                                    }
                                    else{
                                       var dues_message = "#"; 
                                    }

                                    if(NetPayable != "0")
                                    {
                                        totalfee += totalFeesForStudent;
                                        prevBlance += prevBlanc;
                                        totalPrevYearDues += Number(BackYearDues);
                                        netPay += NetPayable;


                                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                                        var studentImageWithCacheBust = currentDomainWithProtocol + "/storage/" + student_image + "?timestamp=" + new Date().getTime();
                                        
                                        $(".studnt-table").append(`
                                        <tr>
                                            <td>`+sn+`</td>
                                            <td><a href="student-details/`+id+`">
                                               <img src="`+studentImageWithCacheBust+`" alt="student" style="height:40px;padding:2px;border:1px solid  #ccc;"></a>
                                            </td>
                                            <td><a  href="student-details/`+id+`" class="text-dark">`+first_name+` `+middle_name+` `+last_name+`</a></td>
                                            <td>`+classes+' '+section+`</td>
                                            <td>`+id+`</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> `+totalFeesForStudent.toFixed(0)+`</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> `+prevBlanc.toFixed(0)+`</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> `+BackYearDues+`</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> `+NetPayable+`</td>  
                                            <td>
                                               <div class="d-flex flex-column" style="font-size:12px;">
                                                    <span>`+parentName+`</span>
                                                    <b><i class="fa fa-phone-square" aria-hidden="true"></i> `+parentContact+`</b>
                                               </div>
                                             </td>  
                                             <td class="d-flex flex-column align-items-center">
                                               <span onclick="window.open('tel:`+parentContact+`');" visitorbtn="btn" btnName="Call Now" class="material-symbols-outlined ml-3 border p-2 animate__animated animate__swing animate__slow animate__delay-1s animate__repeat-2" style="font-size:17px;border-radius:100px;cursor:pointer;">call</span>
                                               <span style="font-size:8px;">Call Now</span>
                                             </td>
                                      </tr>`);    

                                    var feeType = response.data[increase].FeeTypeWithAmount;
                                    var SchoolName = response.data[0].SchoolDetails.school_name;
                                    var address = response.data[0].SchoolDetails.address;
                                    var logo_img = response.data[0].SchoolDetails.logo_img;
                                    var phone = response.data[0].SchoolDetails.phone;
                                    var email = response.data[0].SchoolDetails.email;
                                    var website = response.data[0].SchoolDetails.website;
                                    var pan_no = response.data[0].SchoolDetails.pan_no;
                                    var estd_year = response.data[0].SchoolDetails.estd_year;


                                    if (feeType && Object.keys(feeType).length > 0) {
                                      var FeeType = "";
                                      var FeeIndex = 1;
                                      
                                      Object.keys(feeType).forEach(function(key) {
                                        var sn = FeeIndex++;
                                        var feeAmount = feeType[key] || 0;

                                        var parts = feeAmount.split(",");
                                        var fee = parseInt(parts[0], 10);
                                        var month = parseInt(parts[1], 10);

                                        FeeType += `
                                          <tr style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                            <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+sn+`</td>
                                            <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+key+`</td>
                                            <td style="border: 1px solid #000000; font-size:13px; padding:5px; padding-left:10px;">`+month+`</td>
                                            <th style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-totalfee">`+fee+`</th>
                                          </tr>
                                        `;
                                      });
                                    }
                                    
                                    
                                    if(prevBlanc == "0") {
                                        var preve_tr = "display:none;";
                                    }
                                    else {
                                        var preve_tr = "display:flex;";
                                    }

                                    if(BackYearDues == "0")
                                    {
                                      var yearDues_tr = "display:none;";
                                    }
                                    else{
                                      var yearDues_tr = "display:flex;";
                                    }

                                    var notice = localStorage.getItem('notice');
                                    if (notice === null) {
                                        notice = '';
                                    }
 
                                    // Dues Bil Print 
                                    $(".print-section").append(`

                                    <div class="bill-box" id="my-element" style="background:white; width: 150mm; height: 250mm;  overflow: hidden; ">
                                    <div style="width: 100%; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
                                       <img src="`+currentDomainWithProtocol+`/storage/invoice-bg.jpg"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
                                      
                                        <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                                           <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
                                              <img id="school_logo" src="`+currentDomainWithProtocol+`/storage/`+logo_img+`" style="height:50px; margin: 15px;border:1px solid #f0f1f3;">
                                            </div>
                                            <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                                                <h3 style="margin-top: 20px; font-weight: bolder;">INVOICE</h3>
                                            </div>
                                        </div>
                                       
                                            <div style="width: 100%;">
                                                <center id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                                                  `+SchoolName+`
                                                </center>
                                                <address>
                                                <center><strong style="margin: 10px;" id="school_address">`+address+`</strong></center>
                                                <center><strong style="margin: 20px;" id="estd_year">Estd : `+estd_year+`</strong></center>
                                                <center><strong style="font-size: 13px;margin: 10px;" id="school_contact">Tel : `+phone+`</strong></center>
                                                </address>
                                            </div>
                                       
 
                                          <div style="border: 0px solid black; display: flex; margin: 10px;">
                            
                                            <div style="height: 100px; width: 70%; border: 0px solid black; display: flex;">
                                              <div style="height:100%; align-items: center; margin-left: 10px;">
                                                  <img id="st_image" style="border: 3px solid black; padding: 3px;" src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="student" width="80px;">
                                              </div>
                                              <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;">
                                                  <span style="margin-bottom: 5px;margin-top: 5px;"><b>STUDENT</b></span>
                                                  <div style="margin-bottom: 5px;"><b>Name:</b> <span id="st_name">`+studen_name+`</span></div>
                                                  <div style="margin-bottom: 5px;"><b>Class:</b> <span id="st_class">`+classes+' '+section+`</span> <span id="st_section"></span></div>
                                                  <div style="margin-bottom: 5px;"><b>Roll:</b> <span id="st_roll">`+roll+`</span></div>
                                              </div>
                                            </div>
                                  
                                            <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display: flex; flex-direction: column; align-items: start;">
                                              <div style="margin-bottom: 5px;"><b>Date:</b> <span id="bill-date">`+current_date+`</span></div>
                                              <div style="margin-bottom: 5px;"><b>Bill No: </b><span id="bill_no">`+sn+`</span></div>
                                              <span style="margin-bottom: 5px;"><b>Pan No:</b> `+pan_no+`</span>
                                            </div>
                                          </div>
                                     
                                         
                                            <div class="bill-content" style="padding: 0px;margin: 10px;">
                                            <table style="border:1px solid black;font-family: arial, sans-serif;margin-top:15px;border-collapse: collapse;width: 100%;">
                                            <tr style="border: 1px solid #000000;text-align: left;padding: 15px;">
                                                <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">SN:</th>
                                                <th style="border-right: 1px solid #747373;padding: 8px;font-size:11px;">Particulars</th>
                                                <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Mo.</th>
                                                <th style="border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Amount</th>
                                            </tr>
                            
                                            
                                            <div><b>Months : </b> <span>up to `+lastCheckedMonth+`</span></div>
                                            <div class="bill-particular-data" id="bill-particular-data">
                                              `+FeeType+`
                                            </div>

                                            </table>

                                            <center>
                                                <div style="width:290px; margin-left:12px; margin-top:20px;">
                                                
                                                    <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px dashed black;">
                                                        <b>Total :</b>
                                                        <span style="margin-left:100px;">`+totalFeesForStudent.toFixed(0)+`</span>
                                                    </div>

                                                    <div style="`+preve_tr+` justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px inset black;">
                                                        <b>Prev. Bal. :</b>
                                                        <span style="margin-left:100px;">`+prevBlanc+`</span>
                                                    </div>

                                                    <div style="`+yearDues_tr+` justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px inset black;">
                                                        <b>Prev. Year :</b>
                                                        <span style="margin-left:100px;">`+BackYearDues+`</span>
                                                    </div>

                                                    <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                                                        <b>Net Payable :</b>
                                                        <b style="margin-left:100px;">`+NetPayable+`</b>
                                                    </div>
                                                </div>
                                            </center>


                                            <div style="margin-top:20px;">
                                                <b>Amount in words :</b>
                                                 <span>`+NepaliFunctions.NumberToWords(NetPayable, false)+" Only."+`</span><br>
                                            </div>

                                            <div style="margin-top:10px;">
                                                <b>Notice :</b>
                                                <span>`+notice+`</span><br>
                                            </div>

                
                                        </div>
                                   
                
                            
 
                            
                                        <div style="position: absolute; bottom:20px; height: 50px;width: 100%; display:flex; justify-content:center; align-items:center; ">
                                            <span style="text-align:center;font-size:12px;">Thank you for your prompt payment. <br> Your support enables us to continue providing quality education.</span>
                                        </div>
                            
                            
                                    </div> 
                                </div>  
                                    `);

                                    }
                                    // <b class="d-none">शब्दों में :</b>
                                    // <span class="d-none">`+NepaliFunctions.NumberToWordsUnicode(duesForStudent.toFixed(0), true)+`</span>

                                });

                                $(".total-row").removeClass("d-none");

                                $(".totalfee").html('<i class="fa fa-inr" aria-hidden="true"></i> '+totalfee.toFixed(0));
                                $(".prevBlanc").html('<i class="fa fa-inr" aria-hidden="true"></i> '+prevBlance.toFixed(0));
                                $(".preYear").html('<i class="fa fa-inr" aria-hidden="true"></i> '+totalPrevYearDues);
                                $(".netPay").html('<i class="fa fa-inr" aria-hidden="true"></i> '+netPay);


                                if(totalfee-totalpayment != "0")
                                {
                                  $(".message-btn-box").removeClass("d-none");
                                }
                                else{
                                  $(".message-btn-box").addClass("d-none");
                                }


                            }
                            else{
                                $(".studnt-table").html(``); 
                                $(".studnt-table").append(`
                                   <th colspan="7" class="border"><center>Student Not In Class</center></th>
                                `);
                                $(".total-row").addClass("d-none");
                            }
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

    var current_month = NepaliFunctions.GetCurrentBsDate().month-1;

    for (var i = 0; i <= current_month; i++) {
         $('input[value="month_' + i + '"]').click();
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


 




 