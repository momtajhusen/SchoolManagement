
<div class="d-flex flex-column">
    <span style="font-size:12px">Select Fee Year</span>
    <select st_id='' class="form-select form-select-sm select-admission-fee" aria-label=".form-select-sm example">
           {{-- Select option --}}
    </select>
 </div>



 {{-- Script  --}}
 <script>
    $(document).ready(function(){
       $('.select-admission-fee').html(`
          <option value="`+current_year+`">`+current_year+`</option>
       `);
    });

        // Retrive Admission Year
        function studentAdmissionYear(st_id){

        


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/get-student-admission-year",
            data:{
                st_id: st_id, 
                current_year: current_year,  
            },
            method: "GET",
            // Success
            success: function (response) {


                console.log(response);

                console.log(response.YearsBetween);

   
                if(response.YearsBetween){
                    if(response.YearsBetween.length != 0){
                        $('.select-admission-fee').html(``);
                        response.YearsBetween.forEach(function(year, index) {
                            $('.select-admission-fee').append(`
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