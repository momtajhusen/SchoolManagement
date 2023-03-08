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
                }, 3);
              }
              
              updateCounter(".techer-count", response.Total_Teacher);
              updateCounter(".student-count", response.Total_Student);
              updateCounter(".parents-count", response.Total_Parents);
              
         }
    });


});