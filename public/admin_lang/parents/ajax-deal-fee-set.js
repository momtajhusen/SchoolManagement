
// Save Deal Fee 
$(document).ready(function(){
    $(".save-deal-fee").click(function(){
        var checkedMonths = [];
        var checkedfeeType = [];
        var fee_amount = $('.deal-fee').val();
        var st_id = $(this).attr('st_id');

        // Collect checked months
        $('.month-input:checked').each(function() {
            checkedMonths.push($(this).val());
        });
        
        // Collect checked fee types
        $('.fee-type:checked').each(function() {
            checkedfeeType.push($(this).val());
        });

        if(fee_amount <= 0){
            alert('Enter Fee');
            return false;
        }

        if(checkedMonths.length == 0){
            alert('Select Month');
            return false;
        }
        if(checkedfeeType.length == 0){
            alert('Select Fee Type');
            return false;
        }

        // Send the AJAX request
        $.ajax({
            url: "/admin/save-deal-fee",
            method: "POST",
            data: {
                checkedMonths: checkedMonths,
                checkedfeeType: checkedfeeType,
                fee_amount: fee_amount,
                st_id: st_id,
                year: current_year,

            },
            success: function (response) {
                console.log(response);
                if(response.status == 'Data saved successfully')
                {
                    iziToast.success({
                        title: 'Save',
                        message: 'Save Successfully !',
                        position: 'topRight', 
                        timeout: 2000,
                    });
                    $(".close-model").click();
                    $(".selected-sudent").click();
                }
                // Handle success response here
            },
            error: function (xhr, status, error) {
                // Error callback function
                console.log(xhr.responseText); // Log the error response in the console
            }
        });
    });
});
