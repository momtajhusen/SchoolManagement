// Retrive All Student
$(document).ready(function(){

    $(".search-btn").click(function(){
        var select_year = $(".select-year").val();
        var select_month = $(".select-month").val();
        alert(select_year+" "+select_month);
    });
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/registration-list",
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

            $(".table-body").html(``);
            if(response.message != "data not found"){
             var count = 0;
             response.data.forEach(function(data){
              var increase = count++
              var id = response.data[increase].id;
              var student_image = response.data[increase].student_image;
              var first_name = response.data[increase].first_name;
              var middle_name = response.data[increase].middle_name;
              var last_name = response.data[increase].last_name;
              var gender = response.data[increase].gender;
              var dob = response.data[increase].dob;
              var phone = response.data[increase].phone;
              var village = response.data[increase].village;
              var municipality = response.data[increase].municipality;
              var district = response.data[increase].district;
              var ward_no = response.data[increase].ward_no;
              var classes = response.data[increase].class;
              var section = response.data[increase].section;


              var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

              $(".table-body").append(`  
              <tr>
              <td>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input">
                      <label class="form-check-label">#0027</label>
                  </div>
              </td>
              <td class="text-center"><a href="student-details/`+id+`"><img src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="student"></a></td>
              <td><a  href="student-details/`+id+`" class="text-dark">`+first_name+` `+middle_name+` `+last_name+`</a></td>
              <td>`+gender+`</td>
              <td>`+classes+`</td>
              <td>`+section+`</td>
              <td>Jakir Husen</td>
              <td>`+village+` `+ward_no+`, `+municipality+`, `+district+` </td>
              <td>`+dob+`</td>
              <td>`+phone+`</td>
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



$(document).ready(function(){
      // Select year 10 year below
  var year = NepaliFunctions.GetCurrentBsDate().year;
  for (let i = 0; i < 10; i++) 
  {
    var yearOption = year - i;
    $(".select-year").append(`
      <option value="${yearOption}">${yearOption}</option>
    `);
  }

    // Set select_month to 11 and trigger change event
    var select_month = NepaliFunctions.GetCurrentBsDate().month - 1;
    $(".select-month").val(select_month).change();
});