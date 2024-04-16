
$(document).ready(function(){

  var full_date = current_year+"-"+current_month+"-"+current_day

  $("#payment_date").val(full_date);

  $(".search-btn").click(function () {
      $(this).html("SEARCH");

      var student_id = "";
      if($(".student-select").val()){
        var student_id = $(".student-select").val();
      }

      if($(".student-id").val()){
        var student_id = $(".student-id").val();
      }

      if (student_id != "") 
      {
          $.ajax({
              url: "/fee-payment-monthly",
              method: "GET",
              data: {
                  student_id: student_id,
                  year: current_year,
              },
              // Success
              success: function (response) {

                  console.log(response);

                  if (response.data) 
                  {
                    $("#payment-history").removeClass("d-none");
                    $(".invoice-box").removeClass("d-none");

                      var student_id = response.data[0].id;
                      var first_name = response.data[0].first_name;
                      var middle_name = response.data[0].middle_name;
                      var last_name = response.data[0].last_name;

                      var admission_date = response.data[0].admission_date;
                      var dateParts = admission_date.split('-'); // Split the date into parts

                      var admission_year = dateParts[0]; 
                      var admission_month = parseInt(dateParts[1]); 

                      var student_name = first_name+" "+middle_name+" "+last_name;
                      var roll_no = response.data[0].roll_no;
                      var classes = response.data[0].class;
                      var section = response.data[0].section;
                      var imgpath = response.data[0].student_image;
                      var hostel_outi = response.data[0].hostel_outi;
                      var hostel_deposite = response.data[0].hostel_deposite;

                      var transport_use = response.data[0].transport_use;
                      var vehicle_root = response.data[0].vehicle_root;
                      var tuition = response.data[0].tuition;

                      // parent data 
                      var pr_id = response.parent_data.id;

  
                      var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                      var imgPathWithCacheBust = currentDomainWithProtocol + "/storage/" + imgpath + "?timestamp=" + new Date().getTime();

                      var InvoiceBgImage = currentDomainWithProtocol + "/storage/invoice-bg.jpg?timestamp=" + new Date().getTime();
                      $("#invoice-bg-image").attr("src", InvoiceBgImage);
                      
                      $("#student_image").attr("src", imgPathWithCacheBust);
                      $("#name").html(student_name);
                      $("#class").html(classes+' '+section);
                      $("#roll").html(roll_no);
                      $(".dropdown_menu").removeClass("d-none");
                      $("#all_reset").attr("st_id",student_id);
                      $("#student_update_id").attr("href", "update-student-details/"+student_id);
                      $("#fee_exception").attr("href", "manage-free-student/"+pr_id);

 
                      if(hostel_deposite != null && hostel_deposite != 0){
                        $("#hostel_deposite_box").removeClass("d-none");
                        $("#deposite-amount").html(hostel_deposite);
                      }
                      else{
                        $("#hostel_deposite_box").addClass("d-none");
                      }

                      if(response.ExceptionFreeFee != "No free fee exception"){
                        $(".free_fee_box").removeClass("d-none");
                      }
                      else{
                        $(".free_fee_box").addClass("d-none");
                      }
                      if(response.ExceptionDiscountFee != "No discount exception"){
                        $(".discount_fee_box").removeClass("d-none");
                      }
                      else{
                        $(".discount_fee_box").addClass("d-none");
                      }

                      if(response.ExceptionFreeFee != "No free fee exception" || response.ExceptionDiscountFee != "No discount exception")
                      {
                        $("#exception-column").removeClass("d-none");
                      }
                      else{
                        $("#exception-column").addClass("d-none");
                      }
                      $("#free_fee_exception").html(response.ExceptionFreeFee);
                      $("#discount_fee_exception").html(response.ExceptionDiscountFee);



                    function toggleIcon(classSelector, condition) {
                        if (condition == "Yes") {
                            $(classSelector).removeClass("d-none");
                        } else {
                            $(classSelector).addClass("d-none");
                        }
                    }
                    toggleIcon(".tuition-icon", tuition);
                    if(hostel_outi == "hostel"){
                      $(".hostel-icon").removeClass("d-none");
                    }
                    else{
                      $(".hostel-icon").addClass("d-none");
                    }

                    if(vehicle_root != null){
                      $(".transport-icon").removeClass("d-none");
                    }
                    else{
                      $(".transport-icon").addClass("d-none");
                    }

                      $("#root").html(vehicle_root);
                      $("#student_id").val(student_id);
                      $("#st_id").html(student_id);
                      $("#pr_id").html(pr_id);
                      $("#joining-btn").removeClass("d-none");


                      // invoice 
                      $(".s_class").html(classes);
                      $(".s_roll").html(roll_no);
                      $(".s_name").html(student_name);

                      
                      // Total Fee 
                      const monthFees = [];
                      for (let i = 0; i < 12; i++) {
                        monthFees[i] = response.feeMonthly["month_" + i];
                      }
                      const [month_fee_0, month_fee_1, month_fee_2, month_fee_3, month_fee_4, month_fee_5, month_fee_6, month_fee_7, month_fee_8, month_fee_9, month_fee_10, month_fee_11] = monthFees;
                      
                      // Payment Amount 
                      var month_pay_0 = 0,month_pay_1 = 0,month_pay_2 = 0,month_pay_3 = 0,month_pay_4 = 0,month_pay_5 = 0,month_pay_6 = 0,month_pay_7 = 0,month_pay_8 = 0,month_pay_9 = 0,month_pay_10 = 0,month_pay_11 = 0;
                      if (response.PaymentFee !== "data not found" && response.PaymentFee[0]) 
                      {
                        month_pay_0 = response.PaymentFee[0].month_0 || 0;
                        month_pay_1 = response.PaymentFee[0].month_1 || 0;
                        month_pay_2 = response.PaymentFee[0].month_2 || 0;
                        month_pay_3 = response.PaymentFee[0].month_3 || 0;
                        month_pay_4 = response.PaymentFee[0].month_4 || 0;
                        month_pay_5 = response.PaymentFee[0].month_5 || 0;
                        month_pay_6 = response.PaymentFee[0].month_6 || 0;
                        month_pay_7 = response.PaymentFee[0].month_7 || 0;
                        month_pay_8 = response.PaymentFee[0].month_8 || 0;
                        month_pay_9 = response.PaymentFee[0].month_9 || 0;
                        month_pay_10 = response.PaymentFee[0].month_10 || 0;
                        month_pay_11 = response.PaymentFee[0].month_11 || 0;
                      }

                      // Total Discount
                      var month_0_dis = response.FeeDiscount && response.FeeDiscount[0].month_0 !== null ? response.FeeDiscount[0].month_0 : 0;
                      var month_1_dis = response.FeeDiscount && response.FeeDiscount[0].month_1 !== null ? response.FeeDiscount[0].month_1 : 0;
                      var month_2_dis = response.FeeDiscount && response.FeeDiscount[0].month_2 !== null ? response.FeeDiscount[0].month_2 : 0;
                      var month_3_dis = response.FeeDiscount && response.FeeDiscount[0].month_3 !== null ? response.FeeDiscount[0].month_3 : 0;
                      var month_4_dis = response.FeeDiscount && response.FeeDiscount[0].month_4 !== null ? response.FeeDiscount[0].month_4 : 0;
                      var month_5_dis = response.FeeDiscount && response.FeeDiscount[0].month_5 !== null ? response.FeeDiscount[0].month_5 : 0;
                      var month_6_dis = response.FeeDiscount && response.FeeDiscount[0].month_6 !== null ? response.FeeDiscount[0].month_6 : 0;
                      var month_7_dis = response.FeeDiscount && response.FeeDiscount[0].month_7 !== null ? response.FeeDiscount[0].month_7 : 0;
                      var month_8_dis = response.FeeDiscount && response.FeeDiscount[0].month_8 !== null ? response.FeeDiscount[0].month_8 : 0;
                      var month_9_dis = response.FeeDiscount && response.FeeDiscount[0].month_9 !== null ? response.FeeDiscount[0].month_9 : 0;
                      var month_10_dis = response.FeeDiscount && response.FeeDiscount[0].month_10 !== null ? response.FeeDiscount[0].month_10 : 0;
                      var month_11_dis = response.FeeDiscount && response.FeeDiscount[0].month_11 !== null ? response.FeeDiscount[0].month_11 : 0;

                      // Total FreeFee
                      // var month_0_free = response.FeeFree && response.FeeFree[0].month_0 !== null ? response.FeeFree[0].month_0 : 0;
                      // var month_1_free = response.FeeFree && response.FeeFree[0].month_1 !== null ? response.FeeFree[0].month_1 : 0;
                      // var month_2_free = response.FeeFree && response.FeeFree[0].month_2 !== null ? response.FeeFree[0].month_2 : 0;
                      // var month_3_free = response.FeeFree && response.FeeFree[0].month_3 !== null ? response.FeeFree[0].month_3 : 0;
                      // var month_4_free = response.FeeFree && response.FeeFree[0].month_4 !== null ? response.FeeFree[0].month_4 : 0;
                      // var month_5_free = response.FeeFree && response.FeeFree[0].month_5 !== null ? response.FeeFree[0].month_5 : 0;
                      // var month_6_free = response.FeeFree && response.FeeFree[0].month_6 !== null ? response.FeeFree[0].month_6 : 0;
                      // var month_7_free = response.FeeFree && response.FeeFree[0].month_7 !== null ? response.FeeFree[0].month_7 : 0;
                      // var month_8_free = response.FeeFree && response.FeeFree[0].month_8 !== null ? response.FeeFree[0].month_8 : 0;
                      // var month_9_free = response.FeeFree && response.FeeFree[0].month_9 !== null ? response.FeeFree[0].month_9 : 0;
                      // var month_10_free = response.FeeFree && response.FeeFree[0].month_10 !== null ? response.FeeFree[0].month_10 : 0;
                      // var month_11_free = response.FeeFree && response.FeeFree[0].month_11 !== null ? response.FeeFree[0].month_11 : 0;
                      

                      // Total Dues 
                      var dues = response.DuesAmount != "data not found" ? response.DuesAmount[0] : null;
                      var month_0_due = dues?.month_0 ?? month_fee_0;
                      var month_1_due = dues?.month_1 ?? month_fee_1;
                      var month_2_due = dues?.month_2 ?? month_fee_2;
                      var month_3_due = dues?.month_3 ?? month_fee_3;
                      var month_4_due = dues?.month_4 ?? month_fee_4;
                      var month_5_due = dues?.month_5 ?? month_fee_5;
                      var month_6_due = dues?.month_6 ?? month_fee_6;
                      var month_7_due = dues?.month_7 ?? month_fee_7;
                      var month_8_due = dues?.month_8 ?? month_fee_8;
                      var month_9_due = dues?.month_9 ?? month_fee_9;
                      var month_10_due = dues?.month_10 ?? month_fee_10;
                      var month_11_due = dues?.month_11 ?? month_fee_11;
                      

                      // Take Payment Btn Block or d-none 
                      var pay_btn = [];
                      for (var i = 0; i < 12; i++) {
                        pay_btn[i] = eval("month_" + i + "_due === '0' ? 'd-none' : 'd-flex d-block'");
                      }
                      
                      // Payment Btn Color or Text Check Paid or Unpaid
                      var pay_texts = [];
                      var pay_bgs = [];
                      for (var i = 0; i <= 11; i++) {
                        var month_due = eval("month_" + i + "_due");
                        var month_fee = eval("month_fee_" + i);


                        // pay_texts[i] = month_due === "0" ? "Paid" : "Unpaid";
                        // pay_bgs[i] = month_due === "0" ? "bg-success" : "bg-danger";

                        if(month_due === "0"){
                            pay_texts[i] = "Paid";
                            pay_bgs[i] = "bg-success";
                        }
                        if(month_due != "0"){
                          pay_texts[i] = "Dues";
                          pay_bgs[i] = "bg-warning";
                        }

                        if(month_fee === month_due){
                          pay_texts[i] = "Unpaid";
                          pay_bgs[i] = "bg-danger";
                        }
          
                      }

                      const months = [
                        { name: 'Baishakh', fee: month_fee_0, pay: month_pay_0, dis: month_0_dis, due: calculateDue(month_pay_0, month_0_dis, month_fee_0), bg: pay_bgs[0], text: pay_texts[0], btn: pay_btn[0] },
                        { name: 'Jestha', fee: month_fee_1, pay: month_pay_1, dis: month_1_dis, due: calculateDue(month_pay_1, month_1_dis, month_fee_1), bg: pay_bgs[1], text: pay_texts[1], btn: pay_btn[1] },
                        { name: 'Ashadh', fee: month_fee_2, pay: month_pay_2, dis: month_2_dis, due: calculateDue(month_pay_2, month_2_dis, month_fee_2), bg: pay_bgs[2], text: pay_texts[2], btn: pay_btn[2] },
                        { name: 'Shrawan', fee: month_fee_3, pay: month_pay_3, dis: month_3_dis, due: calculateDue(month_pay_3, month_3_dis, month_fee_3), bg: pay_bgs[3], text: pay_texts[3], btn: pay_btn[3] },
                        { name: 'Bhadau', fee: month_fee_4, pay: month_pay_4, dis: month_4_dis, due: calculateDue(month_pay_4, month_4_dis, month_fee_4), bg: pay_bgs[4], text: pay_texts[4], btn: pay_btn[4] },
                        { name: 'Asoj', fee: month_fee_5, pay: month_pay_5, dis: month_5_dis, due: calculateDue(month_pay_5, month_5_dis, month_fee_5), bg: pay_bgs[5], text: pay_texts[5], btn: pay_btn[5] },
                        { name: 'Kartik', fee: month_fee_6, pay: month_pay_6, dis: month_6_dis, due: calculateDue(month_pay_6, month_6_dis, month_fee_6), bg: pay_bgs[6], text: pay_texts[6], btn: pay_btn[6] },
                        { name: 'Mangsir', fee: month_fee_7, pay: month_pay_7, dis: month_7_dis, due: calculateDue(month_pay_7, month_7_dis, month_fee_7), bg: pay_bgs[7], text: pay_texts[7], btn: pay_btn[7] },
                        { name: 'Poush', fee: month_fee_8, pay: month_pay_8, dis: month_8_dis, due: calculateDue(month_pay_8, month_8_dis, month_fee_8), bg: pay_bgs[8], text: pay_texts[8], btn: pay_btn[8] },
                        { name: 'Magh', fee: month_fee_9, pay: month_pay_9, dis: month_9_dis, due: calculateDue(month_pay_9, month_9_dis, month_fee_9), bg: pay_bgs[9], text: pay_texts[9], btn: pay_btn[9] },
                        { name: 'Falgun', fee: month_fee_10, pay: month_pay_10, dis: month_10_dis, due: calculateDue(month_pay_10, month_10_dis, month_fee_10), bg: pay_bgs[10], text: pay_texts[10], btn: pay_btn[10] },
                        { name: 'Chaitra', fee: month_fee_11, pay: month_pay_11, dis: month_11_dis, due: calculateDue(month_pay_11, month_11_dis, month_fee_11), bg: pay_bgs[11], text: pay_texts[11], btn: pay_btn[11] },
                      ];
                      
                      function calculateDue(payment, discount, fee) {
                        const totalPayment = parseFloat(payment);
                        const totalDiscount = parseFloat(discount);
                        const totalFee = parseFloat(fee);
 
                      
                        const sum = totalPayment + totalDiscount;
                        const dueAmount = Math.abs(totalFee - sum) < 1 ? 0 : totalFee - sum;
                      
                        return dueAmount.toFixed(2);
                      }
                      

                        // check admission month and year for monthly fee
                        if(current_year != admission_year)
                        {
                            var start_month = 0;
                        }
                        else{
                          var start_month = admission_month-1;
                        }

                        let totalFee = 0;
                        let totalPay = 0;
                        let totalDis = 0;
                        let totalDue = 0;
                        let html = '';
                        for (let i = start_month; i < months.length; i++) {
                          const m = months[i];
                          totalFee += parseFloat(months[i].fee);
                          totalPay += parseFloat(months[i].pay);
                          totalDis += parseFloat(months[i].dis);
                          totalDue += parseFloat(months[i].due);
                          
                          html += `
                            <tr>
                              <td scope="row" style="width:10px;">${i + 1}</td>
                              <td scope="row" style="width:10px;">${m.name}</td>
                              <td scope="row" style="width:10px;">${m.fee}</td>
                              <td scope="row" style="width:10px;">${parseInt(m.pay)}</td>
                              <td scope="row" style="width:10px;">${parseInt(m.dis)}</td>
 
                              <td scope="row" style="width:10px;">${m.due}</td>
                              <td scope="row" style="width:10px;"><button class="${m.bg} border-0 text-light rounded px-4 btn">${m.text}</button></td>
                              <td scope="row" style="width:10px;"><button class="bg-info take-pay border-0 text-light btn rounded p-2 px-4 ${m.btn}" month="month_${i}" paid="${m.pay}" dues_fee="${m.due}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer">Payment</button></td>
                              <td style="width:70px;">
                                <div class="form-check justify-content-center ${m.btn}">
                                  <input type="checkbox" class="form-check-input"  month="month_${i}" paid="${m.pay}" dues_fee="${m.due}" value="" id="check_${i}">
                                  <label class="form-check-label" for="check_${i}" style="cursor:pointer;"></label>
                                </div>
                              </td>
                            </tr>
                          `;
                        }

                        var backyearlength = response.BackYear.length;
                        var backyeartotal = 0;
                        var backyearpayment = 0;
                        var backyeardiscount = 0;
                        var class_years = "";
                        var lastYearTr = "";
                        
                        for (var i = 0; i < backyearlength; i++) {

                          var class_year = response.BackYear[i].class_year;
                          var total_fee = response.BackYear[i].total_fee;
                          var total_payment = response.BackYear[i].total_payment;
                          var total_discount = response.BackYear[i].total_discount;

                          var total_dues = Math.abs(Number(total_payment) + Number(total_discount) - Number(total_fee));

                          var disp = total_dues == 0 ? "d-none" : "";

                          lastYearTr += `<tr class="`+disp+`">
                          <td scope="row" style="width:10px;">0</td>
                          <td scope="row" style="width:10px;">`+class_year+`</td>
                          <td scope="row" style="width:10px;">`+total_fee+`</td>
                          <td scope="row" style="width:10px;">`+total_payment+`</td>
                          <td scope="row" style="width:10px;">`+total_discount+`</td>
                          <td scope="row" style="width:10px;">`+total_dues+`</td>
                          <td scope="row" style="width:10px;"><button class="bg-danger border-0 text-light rounded px-4">unpad</button></td>
                          <td scope="row" colspan="2" style="width:10px;">
                            <button class="bg-info last-year-payment border-0 text-light rounded btn p-2 px-4"  dues_year="`+class_year+`" dues_fee="`+total_dues+`" data-bs-toggle="modal" data-bs-target="#backYearModal" style="cursor:pointer">Payment Last years</button>
                          </td>
                          </tr>`;

                        }

                        $("#totalClassFee").html(totalFee.toFixed(0));
                        $("#totalClassPay").html(totalPay.toFixed(0));
                        $("#totalClassDis").html(totalDis.toFixed(0));
                        $("#totalClassDue").html(totalDue.toFixed(0));

                        $(".payment-table").html(lastYearTr+html);
                        $("#back-year-btn").attr("st_id", student_id);
                      
                  } 
                  
                  if(response.message){
                    resetData();
                    alert(response.message);
                    $(".student-id").val("");
                  }

                  var MonthArry = {
                    "month_0": "Baishakh",
                    "month_1": "Jestha",
                    "month_2": "Ashadh",
                    "month_3": "Shrawan",
                    "month_4": "Bhadau",
                    "month_5": "Asoj",
                    "month_6": "Kartik",
                    "month_7": "Mangsir",
                    "month_8": "Poush",
                    "month_9": "Magh",
                    "month_10": "Falgun",
                    "month_11": "Chaitra"
                  };

                  if(response.paymentresetStatus != "payment"){
                      var reset_btn = "d-none";
                  }
                  else{
                    var reset_btn = "d-flex";
                  }
                    
                  console.log(response.PaymentHistory);



                  // Start Payment History data in table 
                    $(".history-table").html(``);
                      var count = 0;
                      var sn_no = 1;
                      response.PaymentHistory.forEach(function()
                      {
                          var increase = count++;
                          var index = sn_no++;
                          var history_id = response.PaymentHistory[increase].id;
                          var student_id = response.PaymentHistory[increase].student_id;
                          var payment = response.PaymentHistory[increase].payment;
                          var discount = response.PaymentHistory[increase].discount;
                          var dues = response.PaymentHistory[increase].dues;
                          var pay_date = response.PaymentHistory[increase].pay_date;
                          var pay_month = response.PaymentHistory[increase].pay_month;


                          if(pay_month != 'Previus Year')
                          {
                            if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) 
                            {
                              var pay_month_array = JSON.parse(pay_month);
                              var month_lenghth = pay_month_array.length;
                              var firstMonth = MonthArry[pay_month_array[0]];
                              var lastMonth = MonthArry[pay_month_array[month_lenghth-1]];
                              var months = `${firstMonth} to ${lastMonth}`;
                            } 
                            else{
                                var months = MonthArry[pay_month];
                            }
                          }
                          else{
                            var months = "Prev year "+response.PaymentHistory[increase].class_year;
                          }

                          if (index == 1) {
                              $(".history-table").append(`
                              <tr>
                                <td scope="row">`+history_id+`</td>
                                <td scope="row">`+months+`</td>
                                <td scope="row">`+payment+`</td>
                                <td scope="row">`+discount+`</td>
                                <td scope="row">`+dues+`</td>
                                <td scope="row">`+pay_date+`</td>
                                <td scope="row">
                                <div class="d-flex">
                                  <button class="btn mr-1 px-2 d-flex justify-content-center aligin-items-center last-bill" visitorbtn="btn" btnName="Bill Print" id="bill-btn" history_id="`+history_id+`" student_id="`+student_id+`"  month="`+months+`" style="font-size:15px;" data-toggle="modal" data-target="#staticBackdrop">
                                    <span>Bill Print</span> <span class="material-symbols-outlined ml-1" style="font-size:15px;margin-top:2px;">print</span> 
                                  </button>
                                  <button class="btn justify-content-center aligin-items-center reset-payment-btn `+reset_btn+`" history_id="`+history_id+`" student_id="`+student_id+`" style="font-size:15px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Last Payment">
                                    <span class="material-symbols-outlined" style="font-size:15px;margin-top:2px;">restart_alt</span> 
                                  </button>
                                </div>
                                </td>
                              </tr> 
                          `);
                          }
                          else{
                            $(".history-table").append(`
                            <tr>
                                <td scope="row">`+history_id+`</td>
                                <td scope="row">`+months+`</td>
                                <td scope="row">`+payment+`</td>
                                <td scope="row">`+discount+`</td>
                                <td scope="row">`+dues+`</td>
                                <td scope="row">`+pay_date+`</td>
                                <td scope="row">
                                  <button class="btn px-2 d-flex justify-content-center aligin-items-center" visitorbtn="btn" btnName="Bill Print" id="bill-btn" history_id="`+history_id+`" student_id="`+student_id+`" month="`+months+`" style="font-size:15px;" data-toggle="modal" data-target="#staticBackdrop">
                                    <span>Bill Print</span> <span class="material-symbols-outlined ml-1" style="font-size:15px;margin-top:2px;">print</span> 
                                  </button>
                                </td>
                            </tr> 
                          `);
                          }
                                          

                      });
                  // End Payment History data in table 

              },
              error: function (xhr, status, error) {
                // Parse the response JSON if available
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (xhr.responseText) {
                    // Fallback to the responseText if responseJSON is not available
                    errorMessage = xhr.responseText;
                }
                
                // Display the error message to the user
                console.error(errorMessage);
                // You can also update a specific element on your page with the error message
                // document.getElementById('error-message').innerText = errorMessage;
            }
          });
      }
      else{
        alert("Select Class & Student"); 
        resetData();
      }
  });
});

$(document).ready(function(){
   $(".class_student").click(function(){
     $(".student-id").val("");
     $("#class_student_row").removeClass("d-none");
     $("#student_id_row").addClass("d-none");
     resetData();
   });

   $(".student_id").click(function(){
    $("#student_id_row").removeClass("d-none");
    $("#class_student_row").addClass("d-none");
    resetData();
   });
});

function resetData(){
  $("#payment-history").addClass("d-none");
  $(".payment-table").html(``);
  $("#student_image").attr("src","http://bit.ly/3IUenmf");
  $("#name").html("Student Name");
  $("#class, #roll").html("");
  $("#totalClassFee, #totalClassPay, #totalClassDis, #totalClassDue").html("");
  $(".service-icon, .invoice-box").addClass("d-none");
  $("#st_id, #pr_id").html("");
};

// Take Payment Click Open Model
$(document).ready(function(){
  $(".payment-table").on("click", ".take-pay", function () 
  {


    // unchecked if any checkbox checked
    $(".form-check-input").each(function()
    {
        if($(this).val() == "on")
        {
          $(this).prop("checked", false);
        }
    });


      $(".monthly_payment").attr("paymode","monthly");
      var dues_fee =  $(this).attr("dues_fee");
      var already_pay = $(this).attr("paid");
      var month = $(this).attr("month");

       

     $("#actual_dues").val(dues_fee);
     $("#payment").val(dues_fee);
     $("#total_amount").html(dues_fee);
     $(".already_pay").html(already_pay);
     $("#select_month").val(month);
     $("#discount").val("0");
     $("#percentage").val('0');
     $("#free").val("0");
     $("#comment_free_fee_box").addClass("d-none");
     $("#comment_for_discount").addClass("d-none");

     $("#last_month").val("0");
 
    var student_id = $("#st_id").html();
    var select_month = $(this).attr("month");


    $.ajax({
      url: "/get-fee-monthly",
      method: "GET",
      data: {
          student_id: student_id,
          year: current_year,
          select_month : select_month,
      },
      success: function (response) {
         console.log(response);


        //  return false;
          //  $("#actual_dues").val(response.DuesAmount);
          //  $("#payment").val(dues_fee);

          $(".fee_stracture").html("");
          var feeTypeWithAmount = response.FeeTypeWithAmount;
          var feeTypeMonth = [];

          // var total_amount = Number($("#total_amount").html());
          var already_pay = Number($(".already_pay").html());

          if(already_pay != "0"){
            var feetype_visible = 'd-none';
          }
          else{
            var feetype_visible = '';
          }

          
          for (const [feeType, feeAmount] of Object.entries(feeTypeWithAmount))
          {
              $(".fee_stracture").append(`
                  <tr>
                  <td class="d-none"> <input id="feetype_checkbox" class="`+feetype_visible+`" fee="`+feeAmount+`" type="checkbox" checked style="cursor:pointer;"> `+feeType +`</td>
                  <td>`+feeType+`</td>
                  <td>` +feeAmount +`</td></tr>
              `);
              
              feeTypeMonth.push(feeType+": "+feeAmount);

          }

          $(".monthly_payment").attr("feeType",feeTypeMonth);

      },
      error: function (xhr, status, error) 
      {
          console.log(xhr.responseText);
      },
});

  });
});

// Year Dues Take Payment Click Open Model
$(document).ready(function(){
$("body").on("click", ".last-year-payment", function(){
    var dues_fee =  $(this).attr("dues_fee");
    var already_pay = $(this).attr("paid");
    var dues_year = $(this).attr("dues_year");

    $("#actual_dues_year").val(dues_fee);
    $("#payment_year").val(dues_fee);
    $(".dues_year").val(dues_year);

    $("#previus_discount").val('0');

});
});

// Yearly fee payment check 
$(document).ready(function(){
$("#payment_year").on("input", function(e){
   var actual_dues_year = $("#actual_dues_year").val();
   var payment_amount = $(this).val();
   if(Number(payment_amount) > Number(actual_dues_year))
   {
       $(this).val(actual_dues_year);
   }

});
});
 
// payment 
$(document).ready(function () {
$("#payment").on("input", function (e) {
  var ActualDues = Number($("#actual_dues").val());
  var discount = Number($("#discount").val());
  var payment = Number($("#payment").val());

  if(payment < 0){
    $(this).val(0);
    return false;
  }

  if(ActualDues < payment){
    $("#payment").val(ActualDues);
     $("#percentage").val(0);
     $("#discount").val(0);
     $("#comment_for_discount").addClass("d-none");
   }
  });

  $("input[type='number']").on("keypress", function (e) {
      if (e.key === "+" || e.key === "-" || e.key === "e") {
          e.preventDefault();
      }
  });
});

//Saving
$(document).ready(function () {
$("#discount").on("input", function (e) {

  var ActualDues = Number($("#actual_dues").val());
  var discount = Number($("#discount").val());

  var AfterDiscuntPay = ActualDues - discount;
  $("#payment").val(AfterDiscuntPay);

    if(discount <= 0){
      $("#payment").val(ActualDues);
      $("#percentage").val(0);
      $(this).val(0);
      return false;
    }

    var percentage = (discount / ActualDues * 100).toFixed(3);
    $("#percentage").val(percentage);

    if(discount >= ActualDues){
      $(this).val(ActualDues);
      $("#percentage").val(100);
      $("#payment").val(0);
    }

});

  $("input[type='number']").on("keypress", function (e) {
      if (e.key === "+" || e.key === "-" || e.key === "e" || e.key === ".") {
          e.preventDefault();
      }
  });
});

// Saving & Percentage condition
$(document).ready(function(){
 
  $("#discount,#percentage").on("input",function()
  {  
      if ($(this).val()) {
          // Check if there are leading zeros followed by non-zero digits and remove them
          let inputValue = $(this).val().replace(/^0+(?=[1-9])/, '');
      
          // Set the value to '100' if it's empty
          $(this).val(inputValue || 100);
      }
  });
});

// Percentage 
$(document).ready(function(){
  $("#percentage").on("input", function(e){
      var percentage = $(this).val();
      var ActualDues = Number($("#actual_dues").val());

        if(percentage < 0){
          $(this).val(0);
          return false;
        }

        if(percentage > 100){
          $(this).val(100);
          $("#payment").val(0);
          $("#discount").val(ActualDues);
          return false;
        }

        var discountAmount  = ActualDues / 100 * percentage;
          
        $("#discount").val(discountAmount);

        $("#payment").val(ActualDues - discountAmount);
        
  })
});

// Discount Comment input display 
$(document).ready(function () {
  $('#percentage, #discount').on('input', function () {
    var percentage = $('#percentage').val();

      if(percentage > 0){
        $("#comment_for_discount").removeClass("d-none");
      }

      if(percentage <= 0){
      $("#comment_for_discount").addClass("d-none");
      }
  });
});


$(document).ready(function () {
  $('#percentage').on('keydown', function (e) {
    if (e.keyCode === 190 || e.keyCode === 110) {
      e.preventDefault();
    }
  });
});

// Select year 10 year below
$(document).ready(function(){
      for (let i = 0; i < 10; i++) {
          var yearOption = current_year - i;
          $(".select-year").append(`
        <option value="${yearOption}">${yearOption}</option>
      `);
      }
});

// Free Feetype Select 
$(document).ready(function() {
$("body").on("click", "#feetype_checkbox", function() {
  var checkedamount = 0;
  var actual_dues = Number($("#actual_dues").val());

  $("#feetype_checkbox:checked").each(function() {
    var fee_amount = Number($(this).attr("fee"));
    checkedamount += fee_amount;
    $("#discount").attr("readonly", "readonly");
    $("#discount").css({"background-color": "#ccc"});
    $("#discount").val("0");

    $("#comment_free_fee_box").removeClass("d-none");
  });

  var remaining_dues = actual_dues - checkedamount;

  if (remaining_dues === 0) {
    $("#free").val("0");
    $("#discount").css({"background-color": "white"});
    $("#discount").attr("readonly", false);
    $("#comment_free_fee_box").addClass("d-none");

  } else {
    $("#free").val(remaining_dues);

  }
  $("#payment").val(checkedamount);
});
});
