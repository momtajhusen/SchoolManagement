$(document).ready(function(){

    alert(year);
 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/get-salary-report",
            method: "GET",
            data: {
            year:current_year,
            },
            success: function (response) {
    
                console.log(response);

                if(response.status == 'success'){
                    $('.all_salary').html(response.salary.all_salary);
                    $('.genrate_salary').html(response.salary.genrate_salary);
                    $('.paid_salary').html(response.salary.paid_salary);
                    $('.remaining_salary').html(response.salary.remaining_salary);
                }

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
    
        });

 
});