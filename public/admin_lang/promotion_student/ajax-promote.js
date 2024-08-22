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
        $("#promotion-btn").prop("disabled", true);
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
            success: function(response) {

              console.log(response);
              
              if (response.status == 'Promoted Success') {
                // Display success message for promoted students
                Swal.fire({
                  title: "Student Promoted Successfully!",
                  text: response.PromotedStudent.length + " students have been promoted.",
                  icon: "success",
                  confirmButtonText: "Great!",
                }).then(() => {
                  // Check if there are students who were not promoted
                  const notPromotedStudents = response.NotPromotedStudent || [];
                  if (notPromotedStudents.length !== 0) {
                    const notPromotedNames = notPromotedStudents
                      .map(student => student.split(' ')[0]) // Extract first names
                      .join(", "); // Join names with a comma

                    Swal.fire({
                      title: "Students Not Promoted",
                      text: "The following students couldn't be promoted as they have paid the fees for this class for a few months: " + notPromotedNames,
                      icon: "warning",
                      confirmButtonText: "Understood",
                    });
                  }
                  
                  // Trigger the click event for class-student
                  $("#class-student").click();
                });
              } else {
                // Handle the case where no students were promoted
                Swal.fire({
                  title: "No Students Promoted",
                  text: "No students were promoted. Possible reasons could be:\n" +
                        "- All students are already in the target class.\n" +
                        "- Some students have pending fees.\n" +
                        "- The criteria for promotion were not met.",
                  icon: "info",
                  confirmButtonText: "OK",
                });
              }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
            complete: function() {
                // Re-enable the button after the request is complete
                $("#promotion-btn").prop("disabled", false);
            }
        });
    }
    
        
    });
});