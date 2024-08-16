$(document).ready(function(){
  $("#class-student").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       var select_class = $("#class-select").val();

        $.ajax({
            url: "/get-class-student",
            method: 'GET',
            data:{
              class:select_class,
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
 
                $(".promotion-table").html(``);
                if(response.message != "student not found"){
                 var count = 0;
                 response.Student.forEach(function(){
                  var increase = count++;
                  var id = response.Student[increase].id;
                  var student_image = response.Student[increase].student_image;
                  var first_name = response.Student[increase].first_name;
                  var middle_name = response.Student[increase].middle_name;
                  var last_name = response.Student[increase].last_name;
                  var classes = response.Student[increase].class;
                  var section = response.Student[increase].section;
                  var roll = response.Student[increase].roll_no;

                  var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

    
                  $(".promotion-table").append(`  
                  <tr>
                  <td>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" value="off" stid="`+id+`">
                          <label class="form-check-label">`+id+`</label>
                      </div>
                  </td>
                  <td><a href="student-details/`+id+`"><img class='hover-image-preview' src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="student" style="height:40px;padding:2px;border:1px solid  #ccc;"></a></td>
                  <td><a  href="student-details/`+id+`" class="text-dark">`+first_name+` `+middle_name+` `+last_name+`</a></td>
                  <td>`+classes+`</td>
                  <td>`+section+`</td>
                  <td>`+roll+`</td>

                   <td>
                      <div class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <span class="flaticon-more-button-of-three-dots"></span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                              <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                              <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                          </div>
                      </div>
                  </td>
              </tr>`);
                 });
                }
                else{
                 $(".table-body").append(`
                 <tr>
                 <td>Fee Not Set For This Class</td>
                 </tr>
                 `);
                }
             },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });

  });
});


$("#class-select").on("change", function(){
//     var select_class = $(this).val();
//     $("#promote-class").empty(); // remove existing options
//     var startIndex = $("#class-select option:selected").index() + 1;
//     $("#class-select option").slice(startIndex).clone().appendTo("#promote-class"); // append new options

//     // check if last option is selected and append to promote-class
//     if ($("#class-select option:last-child").is(":selected")) {
//         $("#promote-class").append($("#class-select option:last-child").clone());
//     }

    $("#class-student").click();
});








 


 