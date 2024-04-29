
// Add Expenses
$(document).ready(function () {
    $(".expenses-form").submit(function (e) {
        e.preventDefault();
 
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                var expenses_date =  $("#expenses_date").val();
                if(!NepaliFunctions.ValidateBsDate(expenses_date)){
                    alert("Invalid Expenses Date !");
                    return false;
                }

                var formData = new FormData(this);
                if($("#check_action").val() != "update")
                {
                    var url = "/add-expenses";
                }
                else{
                    var url = "/update-expenses";
                }
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        // setting a timeout
                        $(".submit-btn").addClass("d-none");
                        $(".progress").removeClass("d-none");
                    },
                    // Progress
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener(
                            "progress",
                            function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete =
                                        (evt.loaded / evt.total) * 100;
                                    var percentComplete =
                                        percentComplete.toFixed(2);
                                    $(".progress-bar").width(
                                        percentComplete + "%"
                                    );
                                    $(".progress-bar").html(
                                        percentComplete + " %"
                                    );
                                }
                            },
                            false
                        );
                        return xhr;
                    },
                    // Success
                    success: function (response) {

                        console.log(response.status);
                        console.log(response);



                        if(response.status == "Expenses Add Sucess"){
                            Swal.fire({
                                title: "Expenses Add Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });
                        }
        
                        else if(response.status == "Expenses Update Success")
                        {
                            Swal.fire({
                                title: "Expenses Update Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });
                        }
 
        
                        $(".submit-btn").removeClass('d-none');
                        $(".progress").addClass('d-none');
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });
    });
});

// Get All Expenses
$(document).ready(function () {
 
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $.ajax({
        url: "/get-all-expenses",
        method: "GET",
        // Success
        success: function (response) {
           console.log(response);
 
           var count = 0;
           var index = 1;

           var length = response.data.length;
           response.data.forEach(function(data){
            var increase = count++
            var sn = length--;

            var id = response.data[increase].id;
            var expenses_name = response.data[increase].expenses_name;
            var expenses_category = response.data[increase].expenses_category;
            var amount = response.data[increase].amount;
            var expenses_date = response.data[increase].expenses_date;

            $(".table-body").append(`  
            <tr>
            <td>`+sn+`</td>
            <td>`+expenses_name+`</td>
            <td>`+expenses_category+`</td>
            <td>`+amount+`</td>
            <td>`+expenses_date+`</td>
             <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="flaticon-more-button-of-three-dots"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item delete-expenses" ex_id="`+id+`" href="#"><i class="fas fa-trash text-danger"></i> Delete</a>
                        <a class="dropdown-item edit-expenses" ex_id="`+id+`" ex_name="`+expenses_name+`" ex_cate="`+expenses_category+`" ex_amount="`+amount+`" ex_date="`+expenses_date+`" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                    </div>
                </div>
            </td>
        </tr>`);
    });

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
 
});


// Delete Expenses 
$(document).ready(function(){
    $(".table-body").on("click", ".delete-expenses", function () {

        Swal.fire({
            title: 'Sure you want to Delete ?',
            text: "Do you want to delete expenses ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#00032e',
            cancelButtonColor: '#00032e',
            confirmButtonText: 'Yes Delete',
            cancelButtonText: 'Cancle ',
          }).then((result) => {
            if (result.isConfirmed) {

                var expenses_id = $(this).attr("ex_id");


                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/delete-expenses",
                    method: "POST",
                    data: {
                        expenses_id: expenses_id,
                    },
                    beforeSend: function () {
                        // setting a timeout
                        // $(".submit-btn").addClass("d-none");
                        // $(".progress").removeClass("d-none");
                    },
                    // Success
                    success: function (response) {

                        if (response.status == "Delete Success") {
                            Swal.fire(
                                "Expenses Delete Success !",
                                "You clicked the button!",
                                "success"
                            ).then(function() {
                                location.reload();
                              }); 
                        } else {
                            alert("Expenses not found");
                        }
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });


 
            }
          })

    });
});


// Class Edit for Update 
$(document).ready(function(){
    $(".table-body").on("click", ".edit-expenses", function () {
        var ex_id = $(this).attr("ex_id");

        var ex_name = $(this).attr("ex_name");
        var ex_cate = $(this).attr("ex_cate");
        var ex_amount = $(this).attr("ex_amount");
        var ex_date = $(this).attr("ex_date");
 

        $("#check_action").val("update");
        $(".submit-btn").html("Update");

        $('input[name="ex_id"]').val(ex_id);
        $('input[name="expenses_name"]').val(ex_name);
        $('input[name="expenses_date"]').val(ex_date);
        $('input[name="amount"]').val(ex_amount);

        $("#ex_cate option").filter(function () {
            return $(this).text() == ex_cate;
        }).prop("selected", true);
    });
});