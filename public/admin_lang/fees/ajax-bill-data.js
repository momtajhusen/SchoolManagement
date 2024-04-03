$(document).ready(function(){
    $(".history-table").on("click", "#bill-btn", function()
    {

        setTimeout(function(){
            $('#printBtn').click();
        },500);
 
        var student_id = $(this).attr("student_id");
        var history_id = $(this).attr("history_id");

        var class_select = $(".class-select").val();
        var student_id = $(this).attr("student_id");
        var history_id = $(this).attr("history_id");

        var month = $(this).attr("month");

        $("#bill_month").html(month);


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            url: "/bill-data",
            method: "GET",
            data: {
                class_select: class_select,
                year: current_day,
                student_id: student_id,
                history_id: history_id,
            },
            beforeSend: function () {
                // setting a timeout
                $(".submit-btn").addClass("d-none");
                $(".progress").removeClass("d-none");
            },
            success(response){

                console.log(response);
                $(".bill-particular-data").html('');

    
               var id = response.PaymentHistory[0].id;
               var st_roll = response.PaymentHistory[0].roll_no;

               var classes = response.PaymentHistory[0].class;
               var payment = Number(response.PaymentHistory[0].payment);
               var discount = Number(response.PaymentHistory[0].discount);
               var dues = Number(response.PaymentHistory[0].dues);
               var pay_date = response.PaymentHistory[0].pay_date;

               var st_id = response.Student[0].id;
               var first_name = response.Student[0].first_name;
               var middle_name = response.Student[0].middle_name;
               var last_name = response.Student[0].last_name;
               var st_image = response.Student[0].student_image;
               var section = response.Student[0].section;
            //    var father_name = response.Parents[0].father_name;
               var st_name = first_name+" "+middle_name+" "+last_name;

               var school_logo = response.SchoolDetails[0].logo_img;
               var school_name = response.SchoolDetails[0].school_name;
               var school_address = response.SchoolDetails[0].address;
               var school_contact = response.SchoolDetails[0].phone;
               var school_email = response.SchoolDetails[0].email;
               var pan_no = response.SchoolDetails[0].pan_no;
               var estd_year = response.SchoolDetails[0].estd_year;

               if(discount == "0")
               {
                  $("#discount_tr").css("display", "none");
               }
               else{
                $("#discount_tr").css("display", "");
               }

               $(".bill_no").html(id);
               $(".pan_no").html(pan_no);
               $(".st_class").html(classes);
               $(".st_section").html(section);
               $(".st_name").html(st_name);
               $(".bill_st_id").html(st_id);


               var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
               $(".st_image").attr("src", currentDomainWithProtocol+"/storage/"+st_image);

                $(".bill-totalfee").html(payment+discount+dues);
                $("#bill-payment").html(payment);
                $("#bill-discount").html(discount);
                $("#bill-dues").html(dues);
                $(".bill-date").html(pay_date);
                $("#bill-bg-image").attr("src", currentDomainWithProtocol+"/storage/invoice-bg.jpg");
 
                $(".school_logo").attr("src", currentDomainWithProtocol+"/storage/"+school_logo);
                $(".school_name").html(school_name);
                $(".school_address").html(school_address);
                $(".school_contact").html(school_contact);
                $(".school_email").html(school_email);
                $(".estd_year").html("Estd : "+estd_year);

                var particular = response.PaymentHistory[0].particular;
                var particularArr = particular.split(",");
                var result = [];
                
                $.each(particularArr, function(i, item) {
                    var keyVal = item.split(":");
                    var obj = {};
                    obj[keyVal[0].trim()] = keyVal[1].trim();
                    result.push(obj);
                  });

                  $(".bill-particular-data").html('');
                  $(".particular_tr").css("display", "none");
                  var index = 1;
                  for (var i = 0; i < result.length; i++) {
                   var sn = index++;
                      $("#particular_" + i).css("display", "");

                      var particularName = Object.keys(result[i])[0];
                      var amount = Object.values(result[i])[0];

                      $("#particular_" + i + " td:eq(0)").html(sn);
                      $("#particular_" + i + " td:eq(1)").html(particularName);
                      $("#particular_" + i + " td:eq(2)").html(amount);
                  }
                  $("#bill-modal-cancle").click();
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});