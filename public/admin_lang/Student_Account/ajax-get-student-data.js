// Retrive All Student
$(document).ready(function(){
 
 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/get-student-data",
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

            alert(response);

          console.log(response);

          return false;

          if(response.message != "data not found"){
            var count = 0;
            response.data.forEach(function(data){
                var increase = count++
                var id = response.data[increase].id;
                
                var student_image = response.data[increase].student_image;
                var first_name = response.data[increase].first_name;
                var middle_name = response.data[increase].middle_name;
                var last_name = response.data[increase].last_name;
                var classes = response.data[increase].class;
                var roll_no = response.data[increase].roll_no;
                var section = response.data[increase].section;




                $(".student-box").append(`
                    <div class="card mx-2" style="background-color:#042954;">
                    <div class="w-100 p-3">
                      <img src="http://127.0.0.1:8000/storage/`+student_image+`" alt="Avatar" style="width:100%">
                    </div>
                    <div class="container pt-3">
                       <span class="py-2 my-3 text-light"><b>`+first_name+` `+middle_name+` `+last_name+`</b></span> 
                        <div class="d-flex flex-column">
                           <span class="text-light">Class : `+classes+' '+section+`</span>
                           <span class="text-light">Roll No : `+roll_no+`</span>
                        </div>
                    </div>
                    </div>

 
                `);

            });

            }
 

         }
    });


});