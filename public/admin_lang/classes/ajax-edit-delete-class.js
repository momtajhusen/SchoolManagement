// Class Edit for Update 
$(document).ready(function(){
    $(".class-table").on("click", ".edit-class", function () {
        var class_id = $(this).attr("class_id");

        var classes = $(this).attr("classes");
        var section = $(this).attr("section");
        var class_teacher = $(this).attr("class_teacher");
        var start_date = $(this).attr("start_date");
        var end_date = $(this).attr("end_date");
        var capacity = $(this).attr("capacity");
        var location = $(this).attr("location");

        $("#check_action").val("update");
        $(".submit-btn").html("Update");

        $('input[name="class_id"]').val(class_id);
        $('input[name="capacity"]').val(capacity);
        $('input[name="start_date"]').val(start_date);
        $('input[name="end_date"]').val(end_date);
        $('input[name="location"]').val(location);

        $(".class option").filter(function () {
            return $(this).text() == classes;
        }).prop("selected", true);

        $(".section option").filter(function () {
            return $(this).text() == section;
        }).prop("selected", true);

        $(".class_teacher option").filter(function () {
            return $(this).text() == class_teacher;
        }).prop("selected", true);

    });
});

// Delete Class 
$(document).ready(function(){
    $(".class-table").on("click", ".delete-class", function () {

        Swal.fire({
            title: 'Sure you want to Delete ?',
            text: "Do you want to delete class ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#00032e',
            cancelButtonColor: '#00032e',
            confirmButtonText: 'Yes Delete',
            cancelButtonText: 'Cancle ',
          }).then((result) => {
            if (result.isConfirmed) {

                var class_id = $(this).attr("class_id");

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/delete-class",
                    method: "POST",
                    data: {
                        class_id: class_id,
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
                                "Class Delete Success !",
                                "You clicked the button!",
                                "success"
                            ).then(function() {
                                location.reload();
                              }); 
                        } else {
                            alert("class not found");
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