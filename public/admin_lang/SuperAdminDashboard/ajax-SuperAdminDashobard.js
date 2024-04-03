// Retrive All Student
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/super-admin-dashboard-data",
        method: 'GET',
        data:{
          current_year:current_year,
        },
        beforeSend: function() 
        {
         // setting a timeout
           $(".submit-btn").addClass('d-none');
           $(".progress").removeClass('d-none');
        },
        // Progress 
             xhr: function(){
                 var xhr = new window.XMLHttpRequest();
                 xhr.upload.addEventListener("progress", function(evt) {
                     if (evt.lengthComputable) {
                         var percentComplete = (evt.loaded / evt.total) * 100;
                         var percentComplete =  percentComplete.toFixed(2);
                         $(".progress-bar").width(percentComplete+"%");
                         $(".progress-bar").html(percentComplete+" %");
 
                     }
                 }, false);
                 return xhr;
             },
         // Success 
         success:function(response)
         {

            console.log(response);
 
            function updateCounter(selector, total) {
                var count = 0;
                var interval = setInterval(function() {
                  $(selector).text(count);
                  count++;
                  if (count > total) {
                    clearInterval(interval);
                  }
                }, 5);
              }
              
              updateCounter(".techer-count", response.Total_Teacher);
              updateCounter(".total-astudent-count", response.Total_Student);
              updateCounter(".new-astudent-count", response.New_Students);
              updateCounter(".kickout-astudent-count", response.kickout_students);



              updateCounter(".parents-count", response.Total_Parents);

               $("#exp-amount").html(response.Total_Expenses);
               $("#total-exp-history").html(response.Expenses_History);

               $(".total-advance-payment").html(response.TotalAdvancePaymentAmount);
               $(".total-hostel-deposite").html(response.TotalHostelDepositeAmount);


              

             var male_student = response.Male_Student;
             var female_student = response.Female_Student;

            ////// Start Student Gender Chart /////////
              $("#female-number").html(female_student);
              $("#male-number").html(male_student);
              const ctx_gender = document.getElementById('gender-chart');
              new Chart(ctx_gender, {
                type: 'pie',
                data: {
                  labels: ['Female', 'Male'],
                  datasets: [{
                    label: 'Student',
                    backgroundColor:['#417dfc','#ffaa01'],
                    data: [female_student, male_student],
                    borderWidth: 1
                  }]
                },
                options: {
                    plugins: {
                      legend: {
                        display: false // Hides the legend
                      },
                      tooltip: {
                        enabled: true // Hides the tooltips
                      }
                    },
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
              });
            ////// End Student Gender Chart /////////
 
         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });


});


////// Months Earnings Data/////////
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/month-earning-charts",
        method: 'GET',
        data: {
            current_year: current_year,
        },
         // Success 
         success:function(response)
         {

            console.log(response);


 
         $(".total-earning").html(response.totalpayment);
         $("#collection-amount").html(response.totalpayment);
         $("#total-history").html(response.totalhistory);



         var Bai = response.Bai;
         var Jes = response.Jes;
         var Ash = response.Ash;
         var Shr = response.Shr;
         var Bha = response.Bha;
         var Aso = response.Aso;
         var Kar = response.Kar;
         var Man = response.Man;
         var Pou = response.Pou;
         var Mag = response.Mag;
         var Fal = response.Fal;
         var Cha = response.Cha;
       
           ////// Start Months Earnings Chart /////////
           const ctx_earning = document.getElementById('month-earning-chart').getContext('2d');
           new Chart(ctx_earning, {
             type: 'bar',
             data: {
               labels: ['Bai.', 'Jes.', 'Ash.', 'Shr.', 'Bha.', 'Aso.', 'Kar.', 'Man.', 'Pou.', 'Mag.', 'Fal.', 'Cha.'],
               datasets: [{
                 label: 'Fee Collection',
                 backgroundColor: ['#417dfc', '#ffaa01'],
                 data: [Bai, Jes, Ash, Shr, Bha, Aso, Kar, Man, Pou, Mag, Fal, Cha],
                 borderWidth: 1
               }]
             },
             options: {
               responsive: true, // Enable responsiveness
               maintainAspectRatio: false, // Prevent maintaining aspect ratio
               plugins: {
                 legend: {
                   display: true
                 },
                 tooltip: {
                   enabled: true
                 }
               },
               scales: {
                 y: {
                   beginAtZero: true
                 }
               }
             }
           });
           ////// End Months Earnings Chart /////////



           ////// Start Student Gender Chart /////////
           const ctx_gender = document.getElementById('expense-chart');
           new Chart(ctx_gender, {
             type: 'line',
             data: {
               labels: ['1', '2','3', '4', '5','1', '2','3', '4', '5','11','12'],
               datasets: [{
                 label: 'Expenses',
                 backgroundColor:['#417dfc','#1de9b6'],
                 data: [0, 300,599, 0,146, 134,600, 322,52, 0,432, 124],
                 fill: false,
                 borderColor: 'rgb(75, 192, 192)',
                 tension: 0.1
               }]
             },
             options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Prevent maintaining aspect ratio
                plugins: {
                  legend: {
                    display: true
                  },
                  tooltip: {
                    enabled: true
                  }
                },
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
           });
         ////// End Student Gender Chart /////////



              
         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });


});