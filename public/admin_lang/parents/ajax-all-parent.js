// Retrive All Student
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/get-all-parents",
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

            $(".table-body").html(``);
            if(response.message != "data not found"){
             var count = 0;
             response.data.forEach(function(data){
              var increase = count++
              var id = response.data[increase].id;

              var father_image = response.data[increase].father_image;
              var father_name = response.data[increase].father_name;
              var father_mobile = response.data[increase].father_mobile;
              var father_education = response.data[increase].father_education;

              var mother_image = response.data[increase].mother_image;
              var mother_name = response.data[increase].mother_name;
              var mother_mobile = response.data[increase].mother_mobile;
              var mother_education  = response.data[increase].mother_education;   
              var Kids_id = response.data[increase].Kids_id;

              $(".table-body").append(`  
              <tr>
              <td>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input">
                      <label class="form-check-label">#0027</label>
                  </div>
              </td>
              <td class="text-center"><a href="student-details/`+id+`"><img src="http://127.0.0.1:8000/storage/`+father_image+`" style="height:50px;width:50px;" alt="father_img"></a></td>
              <td><a  href="father-details/`+id+`" class="text-dark">`+father_name+`</a></td>
              <td>`+father_mobile+`</td>
              <td>`+father_education+`</td>
              <td><a href="father-details/`+id+`"><img src="http://127.0.0.1:8000/storage/`+mother_image+`" style="height:50px;width:50px;" alt="mother_img"></a></td>
              <td>`+mother_name+`</td>
              <td>`+mother_mobile+` </td>
              <td>`+mother_education+`</td>
              <td>`+Kids_id+`</td>
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

         }
    });


});