// Retrive All Student
$(document).ready(function () {
    sessionStorage.removeItem("total_amount");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var student_id = $(".student_id").val();

    $.ajax({
        url: "/get-single-student/" + student_id,
        method: "GET",
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
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        var percentComplete = percentComplete.toFixed(2);
                        $(".progress-bar").width(percentComplete + "%");
                        $(".progress-bar").html(percentComplete + " %");
                    }
                },
                false
            );
            return xhr;
        },
        // Success
        success: function (response) {
            feechecke(response);

            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

            if (response.StudentData != "student not avable") {
                $(".student_image").attr("src", currentDomainWithProtocol+"/storage/" +response.StudentData.student_image);
                $(".name").html(
                    response.StudentData.first_name +
                        " " +
                        response.StudentData.middle_name +
                        " " +
                        response.StudentData.last_name
                );
                $(".gender").html(response.StudentData.gender);
                $(".religion").html(response.StudentData.religion);
                $(".father").html(" ");
                $(".dob").html(response.StudentData.dob);
                $(".Religion").html(response.StudentData.religion);
                $(".father_occupation").html(" ");
                $(".email").html(response.StudentData.email);
                $(".admission_date").html(response.StudentData.admission_date);
                $(".class").html(response.StudentData.class);
                $(".section").html(response.StudentData.section);
                $(".roll").html(response.StudentData.roll_no);
                $(".address").html(response.StudentData.village);
                $(".phone").html(response.StudentData.phone);

                $("#" + decremented_current_month).click();
            } else {
                alert("Student Not Avable");
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});

function feechecke(data) {
    console.log(data);

    var student_data = data;
    var fee_stracture_length = student_data.fee_structure.length;

    $(".month-btn").each(function () {
        $(this).click(function () {
            if ($(this).is(":checked")) {
                const months = $(this).val();

                // const match = months.match(/\d+/);
                // const monthNumber = parseInt(match[0]);

                $(".fee_stracture").html("");

                var totalAmount = 0;
                for (let i = 0; i < fee_stracture_length; i++) {
                    var fee_type = student_data.fee_structure[i].fee_type;
                    var amount = student_data.fee_structure[i][months];

                    var checkamount = amount ? amount : "";

                    $(".fee_stracture").append(
                        `
                    <tr>
                    <td>` +
                            fee_type +
                            `</td>
                    <td>` +
                            checkamount +
                            `</td>
                    </tr>
                `
                    );

                    if (amount !== null && !isNaN(amount)) {
                        totalAmount += parseInt(amount, 10);
                    }

                    $(".total_amount").html(totalAmount);
                }

                // Check if the key is available in the session
                // if (sessionStorage.getItem("total_amount") !== null) {
                //     var storeAmount = sessionStorage.getItem("total_amount");
                //     var AddAmount = Number(storeAmount)+Number(totalAmount);
                //     sessionStorage.setItem("total_amount", AddAmount);

                //     const myValue = sessionStorage.getItem("total_amount");

                //     $(".total_amount").html(AddAmount);

                // } else {
                //     ssessionStorage.setItem("total_amount", totalAmount);
                // }
            } else {
                console.log("Checkbox is not checked");
            }
        });
    });
}
