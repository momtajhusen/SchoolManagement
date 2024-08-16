
<div class="d-flex flex-column">
    <span style="font-size:12px">Select Fee Year</span>
    <select pr_id='' class="form-select form-select-sm select-student-fee" aria-label=".form-select-sm example">
         {{-- Select option --}}
    </select>
 </div>




 {{-- Script  --}}
 <script>
    $(document).ready(function(){
       $('.select-student-fee').html(`
          <option value="`+current_year+`">`+current_year+`</option>
       `);
    });

    // Retrive Year
    function studentFeeYearRequest(pr_id){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/get-student-fee-month-year",
            data:{
                pr_id: pr_id,  
            },
            method: "GET",
            // Success
            success: function (response) {
                console.log(response.MonthFeeYear);


                if(response.MonthFeeYear){
                    if(response.MonthFeeYear.length != 0){
                        $('.select-student-fee').html(``);
                        response.MonthFeeYear.forEach(function(year, index) {
                            $('.select-student-fee').append(`
                                <option value="` + year + `">` + year + `</option>
                            `);
                        });
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    }
 </script>