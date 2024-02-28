$(document).ready(function(){
    $("#passout-btn").click(function(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
         var select_class = $("#class-select").val();

 
    // Get all checkboxes except the first one
    var checkboxes = $('.form-check-input:gt(0)');
    var checkedBoxes = checkboxes.filter(':checked');
    var numChecked = checkedBoxes.length;

    var StudentIdArray = [];
    if(numChecked != "0")
    {
        $(".form-check-input:not(:first)").each(function() {
            if ($(this).prop('checked')) 
            {
                StudentIdArray.push($(this).attr("stid"));
            }
        });

 
        $.ajax({
            url: "/passout-class-student",
            method: 'POST',
            data:{
              class:select_class,
              student:JSON.stringify(StudentIdArray),
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
               alert(response);
               $("#class-student").click();
             },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });
    }
    else{
        alert("Please Select Student");
    }


  
    });
  });