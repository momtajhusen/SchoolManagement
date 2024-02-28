 

 
// Tuition Fee Retrive 
$(document).ready(function(){
 
    $.ajax({
        url: "/get-tuition-fee",
        method: 'GET',
         // Success 
        success:function(response)
        {

            // return false;
            var count = 0;
            var count_sn = 1;
            response.data.forEach(function(data){
            var index = count++;
            var sn_no = count_sn++;
                 $(".tuition-stracture-body").append(`
                  <tr>
                    <td>`+sn_no+`</td>
                    <td>
                       <input type="text" readonly name="class[]" value="`+response.data[index].class+`" class="px-2" style="width:100px;border:none;">  
                    </td>
                    <td>
                    <input class="fee_input" type="text" required name="tuition_fee[]" value="`+response.data[index].tuition_fee+`" class="px-2" style="width:80px;">
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
    $(".tuition-fee-structure-form").submit(function (e) {
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
            url: "/tuition-fees-set",
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
                    title: "Tuition Fee Update Success !",
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