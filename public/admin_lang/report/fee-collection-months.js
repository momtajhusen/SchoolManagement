$(document).ready(function(){

    var date = NepaliFunctions.GetCurrentBsDate();
    $.ajax({
        url: "/get-collection-months",
        method: "GET",
        data: {
            year:current_year,
            month:current_month,
            day:current_day,
        },
        success: function (response) {

            console.log(response);

            $("#monthsBox").html('');
            $("#monthsBox").append(`
                <div class="col-6">
                    <div class="my-2 mx-1 monthBox">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">calendar_month</span> 
                                <b>Today</b>
                            </div>
                            <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                        </div>
                        <div class="d-flex mt-2">
                            <span class="material-symbols-outlined">currency_rupee</span>
                            <span class="month_12">`+ response.todayCollection +`</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>This Year</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_12">`+ response.CollectionMonths.year_collection +`</span>
                    </div>
                </div>
            </div>
            `);
            for (var i = 1; i <= 12; i++) {
                var Months = NepaliFunctions.GetBsMonths()[i - 1];
                
                // Use square bracket notation to dynamically access the month property
                var monthValue = response.CollectionMonths['month_' + i];
                $("#monthsBox").append(`
                    <div class="col-6 col-md-3">
                        <div class="my-2 mx-1 monthBox">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="material-symbols-outlined">calendar_month</span> 
                                    <b>`+Months+`</b>
                                </div>
                                <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                            </div>
                            <div class="d-flex mt-2">
                                <span class="material-symbols-outlined">currency_rupee</span>
                                <span class="month_12">`+ monthValue +`</span>
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

 