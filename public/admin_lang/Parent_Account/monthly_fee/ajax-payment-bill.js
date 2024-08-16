$(document).ready(function(){
   get_paymentbill();
   $(".student-box").on("click", ".student-card", function() {
      get_paymentbill();
   });
});

function get_paymentbill(){
   var classvalue = localStorage.getItem('st_class');
   var student_id = localStorage.getItem('st_id');

   if (classvalue != "") 
   {
       if (student_id != "") 
       {
           $.ajax({
               url: "/fee-payment-monthly",
               method: "GET",
               data: {
                   class: classvalue,
                   student_id: student_id,
                   year: current_year,
               },
               // Success
               success: function (response) {

                   //   alert(response.message);
                     console.log(response);

                   if (response.message != "Student not found") 
                   {
 

                       var student_id = response.data[0].id;
                       var first_name = response.data[0].first_name;
                       var middle_name = response.data[0].middle_name;
                       var last_name = response.data[0].last_name;

 
                       var imgpath = response.data[0].student_image
   

                       var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
 
 

                       
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
                         pay_texts[i] = month_due === "0" ? "Paid" : "Unpaid";
                         pay_bgs[i] = month_due === "0" ? "bg-success" : "bg-danger";
                       }

                       const months = [
                             {name: 'Baishakh', fee: month_fee_0, pay: month_pay_0, dis: month_0_dis, due: month_0_due, bg: pay_bgs[0], text: pay_texts[0], btn: pay_btn[0]},
                             {name: 'Jestha', fee: month_fee_1, pay: month_pay_1, dis: month_1_dis, due: month_1_due, bg: pay_bgs[1], text: pay_texts[1], btn: pay_btn[1]},
                             {name: 'Ashadh', fee: month_fee_2, pay: month_pay_2, dis: month_2_dis, due: month_2_due, bg: pay_bgs[2], text: pay_texts[2], btn: pay_btn[2]},
                             {name: 'Shrawan', fee: month_fee_3, pay: month_pay_3, dis: month_3_dis, due: month_3_due, bg: pay_bgs[3], text: pay_texts[3], btn: pay_btn[3]},
                             {name: 'Bhadau', fee: month_fee_4, pay: month_pay_4, dis: month_4_dis, due: month_4_due, bg: pay_bgs[4], text: pay_texts[4], btn: pay_btn[4]},
                             {name: 'Asoj', fee: month_fee_5, pay: month_pay_5, dis: month_5_dis, due: month_5_due, bg: pay_bgs[5], text: pay_texts[5], btn: pay_btn[5]},
                             {name: 'Kartik', fee: month_fee_6, pay: month_pay_6, dis: month_6_dis, due: month_6_due, bg: pay_bgs[6], text: pay_texts[6], btn: pay_btn[6]},
                             {name: 'Mangsir', fee: month_fee_7, pay: month_pay_7, dis: month_7_dis, due: month_7_due, bg: pay_bgs[7], text: pay_texts[7], btn: pay_btn[7]},
                             {name: 'Poush', fee: month_fee_8, pay: month_pay_8, dis: month_8_dis, due: month_8_due, bg: pay_bgs[8], text: pay_texts[8], btn: pay_btn[8]},
                             {name: 'Magh', fee: month_fee_9, pay: month_pay_9, dis: month_9_dis, due: month_9_due, bg: pay_bgs[9], text: pay_texts[9], btn: pay_btn[9]},
                             {name: 'Falgun', fee: month_fee_10, pay: month_pay_10, dis: month_10_dis, due: month_10_due, bg: pay_bgs[10], text: pay_texts[10], btn: pay_btn[10]},
                             {name: 'Chaitra', fee: month_fee_11, pay: month_pay_11, dis: month_11_dis, due: month_11_due, bg: pay_bgs[11], text: pay_texts[11], btn: pay_btn[11]},
                         ];

                         let totalFee = 0;
                         let totalPay = 0;
                         let totalDis = 0;
                         let totalDue = 0;
                         let html = '';
                         for (let i = 0; i < months.length; i++) {
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
                               <td scope="row" style="width:10px;">${m.pay}</td>
                               <td scope="row" style="width:10px;">${m.dis}</td>
                               <td scope="row" style="width:10px;">${m.due}</td>
                               <td scope="row" style="width:10px;"><button class="${m.bg} border-0 text-light rounded px-4">${m.text}</button></td>
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
                             <button class="bg-info last-year-payment border-0 text-light rounded p-2 px-4"  dues_year="`+class_year+`" dues_fee="`+total_dues+`" data-bs-toggle="modal" data-bs-target="#backYearModal" style="cursor:pointer">Payment Last years</button>
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
                   
                   else if(response.message == "Student not found"){
                       $("#payment-table").html(' ');
                       $(".history-table").html(``);
                       $("#payment-history").addClass("d-none");

                        
                       $("#student_image").attr("src","http://bit.ly/3IUenmf"+imgpath);
                       $("#name").html("Student Name");
                       $("#class").html("");
                       $("#roll").html("");
                       $("#hostel_outi").html("");
                       $("#transport_use").html("");
                       $("#root").html("");
                       $("#student_id").val("");
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
                                   <button class="btn mr-1 px-2 d-flex justify-content-center aligin-items-center last-bill" id="bill-btn" history_id="`+history_id+`" student_id="`+student_id+`"  month="`+months+`" style="font-size:15px;" data-toggle="modal" data-target="#staticBackdrop">
                                     <span>View Bill</span>
                                   </button>
                                 </div>
                                 </td>
                               </tr> 
                           `);
                           
 
                                           

                       });
                   // End Payment History data in table 

               },
               error: function (xhr, status, error) 
               {
                   console.log(xhr.responseText);
               },
           });
       }
       else{
           window.location.href = "/parent/dashboard";
       }
   }
   else{
       window.location.href = "/parent/dashboard";
   }
}