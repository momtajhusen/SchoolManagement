// Retrive All Student
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/get-student",
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

          if(response.message != "data not found"){

            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

            $(".parent_name").html(response.ParentData.father_name);
            $("#parent_img").attr("src", currentDomainWithProtocol+"/storage/"+response.ParentData.father_image);

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
                <div class="student-card d-flex border mb-1" st_id="`+id+`" st_class="`+classes+`" style="background-color:#042954;cursor:pointer;">
                    
                    <div class="p-2">
                      <img src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="Avatar" style="height:40px;">
                    </div>

                    <div class="p-2 px-4 d-flex flex-column">
                        <span style="color:#9ea8b5;"><b>`+first_name+` `+middle_name+` `+last_name+`</b></span> 
                        <span style="color:#9ea8b5;font-size:10px;">CLASS : `+classes+' '+section+`</span>
                    </div>
    
                    </div>

 
                `);

            });

            }
 

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });


});



$(document).ready(function() {
    $(".student-box").on("click", ".student-card", function() {
  
     var st_id = $(this).attr("st_id");
     var st_class = $(this).attr("st_class");
  
     localStorage.setItem('st_id', st_id);
     localStorage.setItem('st_class', st_class);
   
    });
});