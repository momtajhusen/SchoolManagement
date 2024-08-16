$(document).ready(function () {
    $(".search-btn").click(function () {
        var classvalue = $(".class-select").val();
        var student_roll = $(".roll-select").val();

        var start_month = $(".start-month").val();
        var end_month = $(".end-month").val();
        var select_year = $(".select-year").val();

        var start_month_text = $(".start-month").find("option:selected").text();
        var end_month_text = $(".end-month").find("option:selected").text();

        if (classvalue != "") {
            $(".preview-class").html(classvalue);
            $(".start-month-tex").html(start_month_text);
            $(".end-month-tex").html(end_month_text);

            $.ajax({
                url: "/check-class-fee",
                method: "GET",
                data: {
                    class: classvalue,
                    student_roll: student_roll,
                    start_month: start_month,
                    end_month: end_month,
                    year: select_year,
                },
                // Success
                success: function (response) {
                    if (response.message != "Student not found") {
                        console.log(response);
                        $(".class-table").html(``);

                        var count = 0;
                        var number = 1;
                        var roll_number = 0;

                        response.data.forEach(function (data) {
                            var index = count++;
                            var sn_no = number++;
                            var id = response.data[index].id;
                            var student_image =
                                response.data[index].student_image;
                            var first_name = response.data[index].first_name;
                            var middle_name = response.data[index].middle_name;
                            var last_name = response.data[index].last_name;
                            var gender = response.data[index].gender;
                            var dob = response.data[index].dob;
                            var phone = response.data[index].phone;
                            var village = response.data[index].village;
                            var municipality =
                                response.data[index].municipality;
                            var district = response.data[index].district;
                            var ward_no = response.data[index].ward_no;
                            var classes = response.data[index].class;
                            var section = response.data[index].section;
                            var roll_no = response.data[index].roll_no;
                            
                            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                        $(".class-table").append(`<tr>
                          <th scope="row" style="width:10px;">` +sn_no +`</th>
                          <td class="p-1" style="width:100px;height:50px;">
                            <a href="student-details/` +id +`"><img src="`+currentDomainWithProtocol+`/storage/` +student_image +`" style="height:100%;" alt="student"></a>
                          </td>
                          <td>` +first_name +" " +middle_name +" " +last_name +`</td>
                          <td id="roll_` +roll_no +`">` +roll_no +`</td>
                          <td>` +response.totalFees +`</td>
                          <td id="payment_` +roll_no +`">0</td>
                          <td id="discount_` +roll_no +`">0</td>
                          <td id="dues_` +roll_no +`">0</td>
                          <td id="total_dues_`+roll_no+`" class="d-none">0</td>
                          <td> 
                              <button type="button" id="btn_` +roll_no +`" roll="` +roll_no +`" s_class="` +classes +`" s_name="` +first_name +" " +middle_name +" " +last_name +`" total="` +response.totalFees +`" dues="0" payment="0" discount="0" class="btn p-2 px-3 border-danger btn-dark invoice-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Invoice
                              </button>
                          </td>
                      </tr>`);

                            ////////// Start Check Payment//////////
                            var FeePayment = response.FeePayment;
                            for (const [roll, feeAmounts] of Object.entries(FeePayment)) 
                            {
                                if (student_roll != "") 
                                {
                                    $("#payment_" + roll_no).html(FeePayment[student_roll]);
                                    $("#btn_" + roll_no).attr("payment", FeePayment[student_roll]);
                                } else {
                                    if ($("#roll_" + roll_no).html() == roll) 
                                    {
                                        $("#payment_" + roll_no).html(feeAmounts);
                                        $("#btn_" + roll_no).attr("payment",feeAmounts);
                                    } 
                                }
                            }
                            ////////// End Check Payment //////////

                            ////////// Start Check Discount//////////
                            var FeeDiscount = response.FeeDiscount;
                            for (const [roll, feeDiscounts] of Object.entries(FeeDiscount)) 
                            {
                                if (student_roll != "") 
                                {
                                    $("#discount_" + roll_no).html(FeeDiscount[student_roll]);
                                    $("#btn_" + roll_no).attr("payment", FeeDiscount[student_roll]);
                                } else {
                                    if ($("#roll_" + roll_no).html() == roll) 
                                    {
                                        $("#discount_" + roll_no).html(feeDiscounts);
                                        $("#btn_" + roll_no).attr("discount",feeDiscounts);
                                    } 
                                }
                            }
                            ////////// End Check Discount //////////

                            ////////// Start Check Dues//////////
                            var DuesAmount = response.DuesAmount;
                            for (const [roll, backDues] of Object.entries(DuesAmount)) 
                            {
                                // with roll
                                if (student_roll != "") {
                                    $("#dues_" + roll_no).html(DuesAmount[student_roll]);
                                    $("#btn_" + roll_no).attr("dues",DuesAmount[student_roll]);

                                    if (DuesAmount[student_roll] == "0" && FeePayment[student_roll] == response.totalFees-FeeDiscount[roll] || DuesAmount[student_roll] == "0" && FeePayment[student_roll] == response.totalFees-FeeDiscount[roll] || response.totalFees > response.totalFees+FeePayment[student_roll]) 
                                    {
                                        $("#btn_" + student_roll).addClass("d-none");
                                    } else {
                                        $("#btn_" + student_roll).removeClass("d-none");
                                    }
                                }
                                // without roll
                                else {
                                    if ($("#roll_" + roll_no).html() == roll) 
                                    {
                                        $("#dues_" + roll_no).html(backDues);
                                        $("#btn_" + roll_no).attr("dues",backDues);


                                        if (backDues == "0" && response.FeePayment[roll] == response.totalFees || backDues == "0" && response.FeePayment[roll] == response.totalFees-FeeDiscount[roll] || response.totalFees > response.totalFees+response.FeePayment[roll]) 
                                        {
                                            $("#btn_" + roll_no).addClass("d-none");
                                        } else {
                                            $("#btn_" + roll_no).removeClass("d-none"); 
                                        }
                                    }
                                }
                            }
                            ////////// End Check Dues //////////

                     
                        });

                        // Invoice Set Fee Type With Amount
                        $(".fee_stracture").html("");
                        var feeTypeWithAmount = response.FeeTypeWithAmount;
                        for (const [feeType, feeAmount] of Object.entries(
                            feeTypeWithAmount
                        )) {
                            $(".fee_stracture").append(`
                                <tr>
                                <td>`+feeType +`</td>
                                <td>` +feeAmount +`</td></tr>
                            `);
                        }
                    } else {
                        $(".class-table").html(``);
                        alert("Student not in class");
                    }
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });
        } else {
            alert("select class");
        }
    });
});

// Invoice Btn Click Data Set in Model
$(document).ready(function () {
    $("body").on("click", ".invoice-btn", function () {
        $(".modal")
            .delay(500)
            .animate({ scrollTop: $(document).height() }, 1000);

        var roll = $(this).attr("roll");
        var s_class = $(this).attr("s_class");
        var s_name = $(this).attr("s_name");

        var backdues = $(this).attr("dues");
        var payment = $(this).attr("payment");
        var total = $(this).attr("total");
        var discount = $(this).attr("discount");

        var payingAmount = Number(payment) + Number(discount);
        var totalPaying =  Number(total)  - Number(payingAmount) + Number(backdues);


        $(".previous_dues").html(backdues);
        $(".total_amount").html(totalPaying);
        $(".already_pay").html(payment);
        $("#discount").val("0");

        $(".s_name").html(s_name);
        $(".s_class").html(s_class);
        $(".s_roll").html(roll);

        $(".payment").val(totalPaying);
    });
});

// Discount
$(document).ready(function () {
    $("#discount").on("input", function (e) {
        var totalPayment = $(".total_amount").html();
        var discount = $(this).val();

        if (Number(totalPayment) > Number(discount)) {
            $(".payment").val(Number(totalPayment) - Number(discount));
        } else {
            $(this).val("0");
            $(".payment").val(Number(totalPayment));
        }
    });
    $("input[type='number']").on("keypress", function (e) {
        if (e.key === "+" || e.key === "-" || e.key === "e") {
            e.preventDefault();
        }
    });
});

$(document).ready(function () {
    $(".payment").on("input", function (e) {
        $("#discount").val("0");
    });
});

// Selector Month than and Year
$(document).ready(function () {
    // Select year 10 year below
    for (let i = 0; i < 10; i++) {
        var yearOption = current_year - i;
        $(".select-year").append(`
      <option value="${yearOption}">${yearOption}</option>
    `);
    }

    $(".start-month").change(function () {
        var select_month = parseInt($(this).val());
        var end_month_select = $(".end-month");
        var options = end_month_select.children();

        options.each(function (index) {
            if (index < select_month) {
                $(this).addClass("d-none");
            } else {
                $(this).removeClass("d-none");
            }
        });

        // Set the first visible option as selected
        var first_visible_option = options.not(".d-none").first();
        end_month_select.val(first_visible_option.val());
    });

    // Set select_month to 11 and trigger change event
    var select_month =  0;
    $(".start-month").val(select_month).change();

    $(".end-month").val(decremented_current_month).change();
});
