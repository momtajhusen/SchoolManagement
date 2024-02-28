$(document).ready(function(){
 
      $("#search-btn").click(function()
      {
  
          // Get all checkboxes except the first one
          var checkboxes = $('.check-box');
          var checkedBoxes = checkboxes.filter(':checked');
          var numChecked = checkedBoxes.length;
  
          var current_year = NepaliFunctions.GetCurrentBsDate().year;
  
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
                      $("#show-month").html(SelectedMonth);
                    }
                    ///////// End Select Month Set ////////
   
                  const SelectMonth = [];
                  $(".check-box").each(function() {
                      if ($(this).prop("checked")) {
                          SelectMonth.push($(this).val());
                      } 
                    });
  
                    $.ajax({
                      url: "/class-finance",
                      method: 'GET',
                      data:{
                      selectmonth:JSON.stringify(SelectMonth),
                      current_year:current_year,
                      },
                      success:function(response)
                      {
  
                          console.log(response);

                          var totalPaymentArray = response.totalPayment;
                          var totalstudent = 0;
                          var totalfee = 0;
                          var totalpayment = 0;
                          var totaldiscount = 0;


  
  
                          $(".class-container").html("");
                          $(".class-fee-table").html(``);
                          // Access the elements in the totalPayment array
                          for (var i = 0; i < response.classData.length; i++) {
                              // var classes = totalPaymentArray[i].class;
                              // var totalClassFee = classData[i].totalClassFee;
                              var totalGenerate = response.classData[i].Generate;
                              var totalPayment = response.classData[i].Payment;
                              var totalDiscount = response.classData[i].Discount;
  
                            //  var totalDues =  Math.abs(Number(totalPayment)+Number(totalDiscount)-Number(totalClassFee));
  
                              // totalstudent += totalStudents;
                              // totalfee += totalClassFee;
                              totalfee += totalGenerate;
                              totalpayment += totalPayment;
                              totaldiscount += totalDiscount;

 
  
                              // $(".class-container").append(`
                              //     <div class="col-12  col-lg-4 mb-3 px-0 px-2">
                              //             <div class="class-box d-flex">
                              //             <div class="h-100" style="width:35%;">
                              //             <div class="w-100 d-flex justify-content-center align-items-center py-4">
                              //                 <span class="material-symbols-outlined" style="font-size: 40px;">
                              //                 other_houses
                              //                 </span>
                              //             </div>
                              //             <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                              //                 <div><b></b> <span  class="my-font">`+classes+`</span></div>
                              //                 <div><b></b> <span  class="my-font">`+totalStudents+`</span></div>
                              //             </div>
                              //             </div>
                              //             <div class="h-100 d-flex flex-column justify-content-center align-items-end p-3" style="width:65%;">
                              //             <div><b>Total Fee :</b> ₹ <span class="my-font">`+totalClassFee.toFixed(0)+`</span></div>
                              //             <div><b>Payment :</b> ₹ <span class="my-font " style="color:#428550;">`+totalPayment.toFixed(0)+`</span></div>
                              //             <div><b>Discount :</b> ₹ <span class="my-font">`+totalDiscount.toFixed(0)+`</span></div>
                              //             <div><b>Dues :</b> ₹ <span class="my-font" style="color:#913636">`+totalDues.toFixed(0)+`</span></div>
                              //             </div>
                              //             </div>
                              //     </div>
                              // `);
  
                              
                              $(".class-fee-table").append(`
                              <tr>
                                  <td>`+response.classData[i].class+`</td>
                                  <td>`+totalfee+`</td>
                                  <td>`+totalPayment.toFixed(0)+`</td>
                                  <td>`+totalDiscount.toFixed(0)+`</td>
                                  <td></td>
                            </tr>`);
                  
                          
                          }
  
                          var totalDues =  Math.abs(Number(totalpayment)+Number(totaldiscount)-Number(totalfee));
  
                          $(".total-student").html(totalstudent);
                          $(".total-fee").html(totalfee.toFixed(0));
                          $(".total-payment").html(totalpayment.toFixed(0));
                          $(".total-discount").html(totaldiscount.toFixed(0));
                          $(".total-dues").html(totalDues.toFixed(0));
  
  
  
  
   
                      },
                      error: function (xhr, status, error) 
                      {
                          console.log(xhr.responseText);
                      },
                  });
              }
          
          else{
              alert("Please Select Months");
          }
     });
   });
  
  
   $(document).ready(function(){
   
      var current_month = NepaliFunctions.GetCurrentBsDate().month-1;
  
      for (var i = 0; i <= current_month; i++) {
           $('input[value="month_' + i + '"]').click();
      }
  
      $("#search-btn").click();
  
          $("#dropdone-selecter").click(function(){
              $(".month-option-box").removeClass("d-none");
          });
          $("#search-btn").click(function(){
              $(".month-option-box").addClass("d-none");
      });
  
  
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
              $("#show-month").html(SelectedMonth);
  
  
            }
            
  
  
   
  });
  
  
   