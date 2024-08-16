
// Save Default Fee Set 
$(document).ready(function(){
    $(".save-default-fee").click(function(){

        var checkedMonths = [];
        var checkedfeeType = [];
        var feeDiscount = [];


 
        var st_id = $(this).attr('st_id');
        var transport_root = $('#root_select').val();

 
        // Collect checked months
        $('.default-month-input:checked').each(function() {
            checkedMonths.push($(this).val());
        });
        
        // Collect checked fee types
        $('.default-fee-type:checked').each(function() {
            checkedfeeType.push($(this).val());
        });

        // Dicount amount with fee
        $('.disc_input').each(function() {
            feeDiscount.push($(this).attr(''));
        });

        if(checkedMonths.length == 0){
            alert('Select Month');
            return false;
        }
        if(checkedfeeType.length == 0){
            alert('Select Fee Type');
            return false;
        }

        // Check if the checkbox is checked
        if ($('.transport_fee').prop('checked')) {
            if(transport_root == ''){
                alert('select Transport Root');
                return false;
            }
        }  

        // console.log(feeDiscount);
        // return false;

        var select_fee_year = $('.select-admission-fee').val();

        // Send the AJAX request
        $.ajax({
            url: "/admin/save-default-fee",
            method: "POST",
            data: {
                checkedMonths: checkedMonths,
                checkedfeeType: checkedfeeType,
                transport_root:transport_root,
                st_id: st_id,
                year: select_fee_year,

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
