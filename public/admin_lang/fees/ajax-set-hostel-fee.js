// Hostel Fee Retrive
$(document).ready(function(){

 
    $.ajax({
        url: "/get-hostel-fee",
        method: 'GET',
         // Success 
        success:function(response)
        {

            var count = 0;
            var count_sn = 1;
            response.hostel_fee.forEach(function(data){
            var index = count++;
            var sn_no = count_sn++;
                 $(".hostel-stracture-body").append(`
                  <tr>
                    <td>`+sn_no+`</td>
                    <td>
                       <input type="text" readonly name="class[]" value="`+response.hostel_fee[index].class+`" class="px-2" style="width:100px;border:none;">  
                    </td>
                    <td>
                      <input class="fee_input" type="text" required name="admission_fee[]" value="`+response.admission_fee[index].admission_fee+`" class="px-2" style="width:80px;">
                    </td>
                    <td>
                      <input class="fee_input" type="text" required name="tuition_fee[]" value="`+response.tution_fee[index].tuition_fee+`" class="px-2" style="width:80px;">
                    </td>
                    <td>
                      <input class="fee_input" type="text" required name="hostel_fee[]" value="`+response.hostel_fee[index].hostel_fee+`" class="px-2" style="width:80px;">
                    </td>
                   </tr>  
                 `);
            });

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});


// Feet Update 
$(document).ready(function(){
    $(".hostel-fee-structure-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        var formData = new FormData(this);
        $.ajax({
            url: "/hostel-fees-set",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
 
            // Success
            success: function (response) {

                console.log(response);
                Swal.fire({
                    title: "Hostel Fee Update Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  });
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});