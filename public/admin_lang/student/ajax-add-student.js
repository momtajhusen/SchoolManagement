$(document).ready(function(){

    $(".student-added-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var admission_date = $(".admission_date").val();
        var admission_year = admission_date.split("/")[2];


    
        var formData = new FormData(this);
        formData.append('admission_year', admission_year);
    
        $.ajax({
            url: "/add-student",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
            //    alert(response);
               $('.student-added-form')[0].reset();
               $(".imagepreview").each(function(){
                 $(this).attr("src", "http://bit.ly/3IUenmf");
               });
               $(".submit-btn").removeClass('d-none');
               $(".progress").addClass('d-none');
               $(".alert-info").removeClass("d-none");
               setTimeout(function(){
                 $(".alert-info").addClass("d-none");
               },3000);

            }
        });

    });

  
});

// Student Roll No  set after class select
$(document).ready(function(){
 
    $(".class-select").change(function() {


        var classvalue = $(this).val();
        var year = $(".admission_date").val();
        var admission_date = year.split("/")[2];

        $.ajax({
            url: "/roll-generate-admission",
            method: 'GET',
            data:{
               class : classvalue,
               admission_date : admission_date,
            },
            beforeSend: function() 
            {
             // setting a timeout
            //    $(".submit-btn").addClass('d-none');
            //    $(".progress").removeClass('d-none');
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
                // alert(response.student);

                $(".student_roll").val(response.student+1);

            }
        });
      });
});

// Student Roll No  set after Clander date change
$(document).ready(function() {
    $(".admission_date").focusout(function() {

        var classvalue = $(".class-select").val();
        var year = $(".admission_date").val();
        var admission_date = year.split("/")[2];

        if(classvalue != "")
        {
            $.ajax({
                url: "/roll-generate-admission",
                method: 'GET',
                data:{
                   class : classvalue,
                   admission_date : admission_date,
                },
                beforeSend: function() 
                {
                 // setting a timeout
                //    $(".submit-btn").addClass('d-none');
                //    $(".progress").removeClass('d-none');
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
                    // alert(response.student);
    
                    $(".student_roll").val(response.student+1);
    
                }
            });
        }



    });
  });








 