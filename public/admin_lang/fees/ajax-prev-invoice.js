$(document).ready(function(){
    $(".search-btn").click(function () {
 

        var checkboxes = $('.check-box');
        var checkedBoxes = checkboxes.filter(':checked');
        var numChecked = checkedBoxes.length;
 
        var student_id = "";
        if($(".student-select").val()){
          var student_id = $(".student-select").val();
        }
  
        if($(".student-id").val()){
          var student_id = $(".student-id").val();
        }

        var current_date = current_year+"-"+current_month+"-"+current_day;


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
 
        }
        ///////// End Select Month Set ////////

        if (checkedValues.length > 0) {
            var firstCheckedKey = checkedValues[0];
            var lastCheckedKey = checkedValues[checkedValues.length - 1];
            var firstCheckedMonth = MonthArry[firstCheckedKey];
            var lastCheckedMonth = MonthArry[lastCheckedKey];

            $("#selected-month").html(lastCheckedMonth);
        }

 
            if (student_id != "") 
            {


                const SelectMonth = [];
                $(".check-box").each(function() {
                    if ($(this).prop("checked")) {
                        SelectMonth.push($(this).val());
                    } 
                  });

                $.ajax({
                    url: "/invoice-data",
                    method: 'GET',
                    data:{
                        student_id: student_id,
                        current_year: current_year,
                        selectmonth:JSON.stringify(SelectMonth),

                    },
                    success: function(response) 
                    {
                        console.log(response);

                        $("#invoice-box").html('');

                        var totalFeesForStudent = response.invoice[0].totalFeesForStudent;
                        var BackYearDues = response.invoice[0].BackYearFee;
                        var prevBlanc = response.invoice[0].PreviusBlance;
                        var NetPayable = totalFeesForStudent + prevBlanc + BackYearDues;

                        // Studenta data 
                        var id = response.invoice[0].id;
                        var student_image = response.invoice[0].student_image;
                        var first_name = response.invoice[0].first_name;
                        var middle_name = response.invoice[0].middle_name;
                        var last_name = response.invoice[0].last_name;
                        var classes = response.invoice[0].class;
                        var section = response.invoice[0].section;
                        var roll = response.invoice[0].roll_no;

                        var studen_name = first_name+" "+middle_name+" "+last_name;

                        // school Data 
                        var SchoolName = response.invoice[0].SchoolDetails.school_name;
                        var address = response.invoice[0].SchoolDetails.address;
                        var logo_img = response.invoice[0].SchoolDetails.logo_img;
                        var phone = response.invoice[0].SchoolDetails.phone;
                        var email = response.invoice[0].SchoolDetails.email;
                        var website = response.invoice[0].SchoolDetails.website;
                        var pan_no = response.invoice[0].SchoolDetails.pan_no;
                        var estd_year = response.invoice[0].SchoolDetails.estd_year;


                        
                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                        var studentImageWithCacheBust = currentDomainWithProtocol + "/storage/" + student_image + "?timestamp=" + new Date().getTime();


                        $("#total_invoice").html(totalFeesForStudent);
                        $("#prev_blan").html(prevBlanc);
                        $("#prev_year").html(BackYearDues);
                        $("#netpay").html(NetPayable);

                        if(BackYearDues == 0){
                            $(".prev_year").css({"display":"none"});
                        }
                        else{
                            $(".prev_year").css({"display":"flex"});

                        }

                        
                        if(prevBlanc == 0){
                            $(".prev_blan").css({"display":"none"});
                        }
                        else{
                            $(".prev_blan").css({"display":"flex"});

                        }

                        if(prevBlanc == "0") {
                            var preve_tr = "display:none;";
                        }
                        else {
                            var preve_tr = "display:flex;";
                        }

                        if(prev_year == "0")
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

                        var feeType =  response.invoice[0].FeeTypeWithAmount;

                        if (feeType && Object.keys(feeType).length > 0) {
                            var FeeType = "";
                            var FeeIndex = 1;

                            Object.keys(feeType).forEach(function(key) {
                                var sn = FeeIndex++;
                                var feeAmount = feeType[key] || 0;

                                // Check if feeAmount is a string before splitting
                                if (typeof feeAmount === 'string') {
                                    var parts = feeAmount.split(",");
                                    var fee = parseInt(parts[0], 10);
                                    var month = parseInt(parts[1], 10);
                                } else {
                                    // If feeAmount is not a string, set fee and month to 0
                                    var fee = feeAmount;
                                    var month = '';
                                }

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



                        $("#invoice-box").html(`
                        <div style="width: 100%; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
                                       <img src="`+currentDomainWithProtocol+`/storage/invoice-bg.jpg"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
                                      
                                        <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                                           <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
                                              <img id="school_logo" src="`+currentDomainWithProtocol+`/storage/`+logo_img+`" style="height:50px; margin: 15px;border:1px solid #f0f1f3;">
                                            </div>
                                            <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                                                <h3 style="margin-top: 20px; font-weight: bolder;">DUES INVOICE</h3>
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
                                              <div style="margin-bottom: 5px;"><b>Bill No: </b><span id="bill_no"></span></div>
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
                            
                            
                                    </div>`);



 

                    },error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });
            }
 
    });
});

// checkbox Condition auto select 
$(document).ready(function() {

    for (var i = 0; i <= current_month; i++) {
         $('input[value="month_' + i + '"]').click();
    }

    $('.check-box').click(function(){
        $(".search-btn").click();
    });

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
 

$(document).ready(function() {
    $('#printInvoice').click(function() {
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
            // Move the printWindow.close() inside a callback function
            // This function will execute after printing or if the user cancels the print dialog
            printWindow.onafterprint = function() {
                printWindow.close();
                $("#bill-modal-cancle").click();
            };
        }, 500);
    });
});
