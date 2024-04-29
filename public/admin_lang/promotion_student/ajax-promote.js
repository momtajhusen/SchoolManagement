$(document).ready(function(){
    $("#promotion-btn").click(function(){

    // Get all checkboxes except the first one
    var checkboxes = $('.form-check-input:gt(0)');
    var checkedBoxes = checkboxes.filter(':checked');
    var numChecked = checkedBoxes.length;

    var from_class = $("#class-select").val();
    var promote_class = $("#promote-class").val();
 
    const PromotedStudent = [];
    const DemotionStudent = [];
    if (!from_class) {
      alert("Please Select Class");
    } else if (!numChecked) {
      alert("Please Select Student");
    } else if (!promote_class) {
      alert("Please Select Promote Class");
    } else {
      
      $(".form-check-input:not(:first)").each(function() {
        if ($(this).prop("checked")) {
          PromotedStudent.push($(this).attr("stid"));
        } else {
          DemotionStudent.push($(this).attr("stid"));
        }
      });
      
      $.ajax({
        url: "/student-promote",
        method: 'POST',
        data:{
        from_class:from_class,
        promote_class:promote_class,
        PromotedStudent:JSON.stringify(PromotedStudent),
        DemotionStudent:JSON.stringify(DemotionStudent),

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
            // $("#class-student").click();
            // return false;

            if(response.PromotedStudent.length != "0"){
   
              Swal.fire({
                title: "Student Promoted Success.",
                text: "You clicked the button!",
                icon: "success",
                confirmButtonText: "OK",
              }).then(function() {
                if(response.NotPromotedStudent.length != "0")
                {
                  var notPromotedNames = "";
                  for (var i = 0; i < response.NotPromotedStudent.length; i++) 
                  {
                      var firstName = response.NotPromotedStudent[i].split(' ')[0];
                      notPromotedNames += firstName + ", "; // add the first name to the string
                  }
                  notPromotedNames = notPromotedNames.slice(0, -2); // remove the trailing comma and space
                  
                  Swal.fire({
                      title: "This student has paid the fees of this class for a few months, now it cannot be promoted.",
                      text: notPromotedNames,
                      icon: "warning",
                      confirmButtonText: "OK",
                  });
                }
              });

              $("#class-student").click();
            }

 


 
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    }
    
        
    });
});