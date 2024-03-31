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


                            $('.student-dues-table').append('');
                            response.forEach(element => {
                              $('.student-dues-table').append(`
                                 <tr>
                                   <td>1</td>
                                   <td>
                                     <img src='../storage/`+element.student_details.student_image+`' style='width:40px;'>
                                   </td>
                                   <td>`+element.student_details.student_name+`</td>
                                   <td>`+element.student_details.class+`</td>
                                   <td>`+element.student_details.id+`</td>
                                   <td>`+element.fee_details.fee_month_amount+`</td>
                                   <td>`+element.fee_details.dues_amount+`</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                 </tr>
                              `);
                                 
                            });
                         
                           
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


 




 