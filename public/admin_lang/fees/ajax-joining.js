
   // Save Change Joining month 
    $(document).ready(function() {
        $("#join-month-save").click(function() {

            var tuitionArray = [];
            var transportArray = [];
            var fullhostelArray = [];
            var halfhostelArray = [];
            var computerArray = [];
            var coachingArray = [];

            var admissionArray = [];
            var annualArray = [];
            var saraswatiArray = [];

            var examArray = [];


        
            // Start  Monthly Fee Stracture Joining ///
                $("[name^='tuition-']").each(function() {
                    var number = parseInt($(this).attr("name").split("-")[1]);
                    tuitionArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[name^='transport-']").each(function() {
                    var number = parseInt($(this).attr("name").split("-")[1]);
                    transportArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });
            
                $("[id^='fullhostel-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    fullhostelArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[id^='halfhostel-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    halfhostelArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[id^='computer-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    computerArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[id^='coaching-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    coachingArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });
            // Start  Monthly Fee Stracture Joining 

            // Start  One time Fee Stracture Joining 
                $("[name^='admission-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    admissionArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[name^='annual-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    annualArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

                $("[id^='saraswati-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    saraswatiArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });

            // End One time Fee Stracture Joining 

            // Start Quarterlies Fee Stracture Joining 
                $("[name^='exam-']").each(function() {
                    var number = parseInt($(this).attr("id").split("-")[1]);
                    examArray[number - 1] = $(this).is(":checked") ? 1 : 0;
                });
            // End Quarterlies Fee Stracture Joining


            
        
            // Filter out undefined elements from the arrays
            tuitionArray = tuitionArray.filter(function(item) {
                return item !== undefined;
            });
            transportArray = transportArray.filter(function(item) {
                return item !== undefined;
            });
            fullhostelArray = fullhostelArray.filter(function(item) {
                return item !== undefined;
            });
            halfhostelArray = halfhostelArray.filter(function(item) {
                return item !== undefined;
            });
            computerArray = computerArray.filter(function(item) {
                return item !== undefined;
            });
            coachingArray = coachingArray.filter(function(item) {
                return item !== undefined;
            });

            admissionArray = admissionArray.filter(function(item) {
                return item !== undefined;
            });
            annualArray = annualArray.filter(function(item) {
                return item !== undefined;
            });
            saraswatiArray = saraswatiArray.filter(function(item) {
                return item !== undefined;
            });
            examArray = examArray.filter(function(item) {
                return item !== undefined;
            });


            var classvalue = $("#class-select").val();
            var student_id = $("#st_id").html();
        
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        
            $.ajax({
                url: "/joining-months-save",
                method: "POST",
                data: {
                    class: classvalue,
                    student_id: student_id,
                    year: current_year,
                    tuitionArray: tuitionArray,
                    transportArray: transportArray,
                    fullhostelArray: fullhostelArray,
                    halfhostelArray: halfhostelArray,
                    computerArray: computerArray,
                    coachingArray: coachingArray,

                    admissionArray: admissionArray,
                    annualArray: annualArray,
                    saraswatiArray: saraswatiArray,

                    saraswatiArray: saraswatiArray,
                    examArray:examArray,

                },
                success: function(response) {
                    
                console.log(response);
        
        
                    if(response == "updated successfully."){
        
                    Swal.fire({
                        title: 'Change Success!',
                        text: "Joining month update sucess.",
                        icon: 'success',
                    }).then((result) => {
                        console.log();
                    })
                    $("#close_joinmonths").click();
                    $(".search-btn").click();
                    }
        
        
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });
        });
    });
    
    // Get Change Joining month 
    $(document).ready(function() {

    $("#joining-btn").click(function(){

        var student_id = $("#st_id").html();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/get-joining-months",
            method: "GET",
            data: {
                student_id: student_id,
                select_year: current_year,
            },
            success: function(response) {
            console.log(response);
        
            if (response.join_months === "No data found") {
                // Unselect all checkboxes
                $("[name^='transport-'], [id^='fullhostel-'], [id^='coaching-']").prop("checked", false);
            } else {
                var tuitionArray = response.join_months.tuitionArray;
                var transportArray = response.join_months.transportArray;
                var fullhostelArray = response.join_months.fullhostelArray;
                var halfhostelArray = response.join_months.halfhostelArray;
                var computerArray = response.join_months.computerArray;
                var admissionArray = response.join_months.admissionArray;
                var annualArray = response.join_months.annualArray;
                var saraswatiArray = response.join_months.saraswatiArray;
                var examArray = response.join_months.examArray;
                var coachingArray = response.join_months.coachingArray;

                var admision_year = response.admision_year;
                var admission_month = response.admission_month;

                $("[name^='tuition-']").each(function(index) {
                    $(this).prop("checked", tuitionArray[index] === '1');
                });
        
                $("[name^='transport-']").each(function(index) {
                    $(this).prop("checked", transportArray[index] === '1');
                });
        
                $("[id^='fullhostel-']").each(function(index) {
                    $(this).prop("checked", fullhostelArray[index] === '1');
                });

                $("[id^='halfhostel-']").each(function(index) {
                    $(this).prop("checked", halfhostelArray[index] === '1');
                });
                
                $("[id^='computer-']").each(function(index) {
                    $(this).prop("checked", computerArray[index] === '1');
                });
        
                $("[id^='coaching-']").each(function(index) {
                    $(this).prop("checked", coachingArray[index] === '1');
                });
                
                $("[id^='admission-']").each(function(index) {
                    $(this).prop("checked", admissionArray[index] === '1');
                });  

                $("[id^='annual-']").each(function(index) {
                    $(this).prop("checked", annualArray[index] === '1');
                });  

                $("[id^='saraswati-']").each(function(index) {
                    $(this).prop("checked", saraswatiArray[index] === '1');
                }); 

                $("[id^='exam-']").each(function(index) {
                    $(this).prop("checked", examArray[index] === '1');
                }); 
            }

                // check admission month and year for joining month remove
                if(current_year == admision_year)
                {                                                
                    for (var i = 0; i < admission_month-1; i++) {
                    $(".month_"+i).addClass("d-none");
                    }
                }
                else{
                    for (var i = 0; i < 12; i++) {
                    $(".month_"+i).removeClass("d-none");
                    }
                }

                //////////// Start  Payment month checkbox disable click ////////////
                //     for (var j = 0; j < 11; j++) {
                //     $(".month_" + j).css({
                //         "background-color": "white",
                //         "cursor": "pointer"
                //     });
                //     $(".month_" + j).removeAttr("onclick");
                //     }

                //     if (response.pay_months.length != 0) {
                //     for (var i = 0; i < response.pay_months.length; i++) {
                //         console.log("Applying styles to: " + response.pay_months[i]);
                //         $("." + response.pay_months[i]).css({
                //             "background-color": "#ddd",
                //             "cursor": "not-allowed"
                //         });
                //         $("." + response.pay_months[i]).attr("onclick", "return false;");
                //     }
                //  } 
                //////////// End  Payment month checkbox disable click ///////////////

        },      
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });



    });


