// Retrive All Student
 $(document).ready(function(){
    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    AllStudent(currentDomainWithProtocol+"/get-all-student?page=1");
 });

 $(document).ready(function(){
    $(".search-student").click(function(){
        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
        AllStudent(currentDomainWithProtocol+"/get-all-student?page=1");
    });
 });

function AllStudent(url){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var student_search_select =  $(".student-search-select").val();
    var student_input_search = $(".student-input-search").val();

    var from_admission_date = $('#from-admission-date').val();
    var to_admission_date = $('#to-admission-date').val();


    $.ajax({
        url: url,
        method: 'GET',
        data:{
            student_search_select : student_search_select,
            student_input_search : student_input_search,
            from_admission_date:from_admission_date,
            to_admission_date:to_admission_date,
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
 
            $(".table-body").html(` `);
            if(response.message != "data not found"){
                // show pagination number 
                var start = response.data.from;

                var links = response.data.links.length-2;

                $(".result_no").html(response.data.total);


                var i; 
                var ul = document.createElement("UL");
                ul.className = "pagination";
                for(i=start;i<=links;i++)
                {
                $(".pagnation-box").html("");

                    var li = document.createElement("LI");
                    li.className = "page-item";
                    $(ul).append(li);

                    var a = document.createElement("a");
                    a.className = "page-link";
                    a.innerHTML = i;
                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                    a.href = currentDomainWithProtocol+"/get-all-student?page="+i;
                    $(li).append(a);

                // get data on click 
                $(a).click(function(e){
                    e.preventDefault();
                    AllStudent($(this).attr("href"));
                    
                });
                    
                }
                
              
                if($(".pagnation-box").html() == "")
                {
                    $(".pagnation-box").append(ul);
                }

             var count = 0;
             var index = 1;
             response.data.data.forEach(function(data){
              var increase = count++
              var sn = index++;
              var id = response.data.data[increase].id;
              var student_image = response.data.data[increase].student_image;
              var first_name = response.data.data[increase].first_name;
              var middle_name = response.data.data[increase].middle_name;
              var last_name = response.data.data[increase].last_name;
              var gender = response.data.data[increase].gender;
              var dob = response.data.data[increase].dob;
              var phone = response.data.data[increase].phone;
              var village = response.data.data[increase].village;
              var municipality = response.data.data[increase].municipality;
              var district = response.data.data[increase].district;
              var ward_no = response.data.data[increase].ward_no;
              var classes = response.data.data[increase].class;
              var section = response.data.data[increase].section;
              var roll_no = response.data.data[increase].roll_no;
              var admission_date = response.data.data[increase].admission_date;



 

              var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

               //   Parents Data 
               var father_name = response.data.data[increase].parent_data.father_name;
               var parent_id = response.data.data[increase].parent_data.id;
               
               var studentImageWithCacheBust = currentDomainWithProtocol + "/storage/" + student_image + "?timestamp=" + new Date().getTime();



              $(".table-body").append(`  
              <tr>
              <td>`+id+`</td>
              <td class="text-center"><a href="student-details/`+id+`"><img src="`+studentImageWithCacheBust+`" alt="student" style="height:40px;padding:2px;border:1px solid  #ccc;"></a></td>
              <td><a  href="student-details/`+id+`" class="text-dark">`+first_name+` `+middle_name+` `+last_name+`</a></td>
              <td>`+gender+`</td>
              <td>`+classes+`</td>
              <td>`+roll_no+`</td>
              <td>`+section+`</td>
              <td>`+admission_date+`</td>
              <td>`+parent_id+`</td>
              <td>`+father_name+`</td>
              <td>`+village+` `+ward_no+`, `+municipality+`, `+district+` </td>
              <td>`+phone+`</td>
               <td>
                  <div class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="flaticon-more-button-of-three-dots"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                          
                        <a class="dropdown-item d-flex" st_id="`+id+`" id="print" href="#">
                          <span class="material-symbols-outlined pr-3">print
                          </span> Print Details
                        </a>

                        <a href="parent-profile/`+parent_id+`" class="dropdown-item parent-profile d-flex">
                          <span class="material-symbols-outlined">person_apron
                          </span>Parent Profile
                        </a>
                          
                        <a href="update-student-details/`+id+`" target="_blank" class="dropdown-item d-flex align-items-center" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Joining Months">
                          <span class="material-symbols-outlined pr-2">person</span>
                          Student Update
                        </a>

                        <a st_id="`+id+`" id="check-out-student" target="_blank" class="dropdown-item d-flex align-items-center" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Joining Months">
                          <span class="material-symbols-outlined pr-2">output</span>
                          Kick Out
                        </a>

                       <a class="dropdown-item d-flex" parent_id="`+parent_id+`" st_id="`+id+`" id="student-delete" href="#">
                        <span class="material-symbols-outlined pr-3">delete
                        </span> Delete
                       </a>

                         
                         
                      </div>
                  </div>
              </td>
          </tr>`);
             });
            }
            else if(response.message == "data not found"){
                $(".result_no").html("0");
                $(".table-body").html(` `);
             $(".table-body").append(`
             <tr>
             <td>Student not found !</td>
             </tr>
             `);
            }

           

            
             // if(response.data[0].notice)
             // {
             //     alert("no data");
             // }

          

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });
}


$(document).ready(function() {
    $('.student-search-select').change(function() {
      var selectedOption = $(this).val();
      $("#student-input").val("");
      
      if(selectedOption == "class")
      {
        // add class select 
        $("#class-select").addClass("student-input-search");
        $("#select-class-col").removeClass("d-none");

        // remove input search 
        $("#student-input").removeClass("student-input-search");
        $("#input-class-col").addClass("d-none");

        // remove hostel select 
        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }

      if(selectedOption == "hostel_outi")
      {

        // add hostel select 
        $("#hostel-select").addClass("student-input-search");
        $("#select-hostel-col").removeClass("d-none");

        // remove input search 
        $("#student-input").removeClass("student-input-search");
        $("#input-class-col").addClass("d-none");

        // remove class select 
        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }

      else if(selectedOption == "first_name"){
        $("#student-input").attr("placeholder", "Enter Student First Name");

        // add input search 
        $("#student-input").addClass("student-input-search");
        $("#input-class-col").removeClass("d-none");

        // remove class select 
        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        // remove hostel select 
        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }

      else if(selectedOption == "village"){
           $("#student-input").attr("placeholder", "Enter Student Village Name");

           // add input search
           $("#student-input").addClass("student-input-search");
           $("#input-class-col").removeClass("d-none");
   
           // remove class select 
           $("#class-select").removeClass("student-input-search");
           $("#select-class-col").addClass("d-none");

           // remove hostel select 
           $("#hostel-select").removeClass("student-input-search");
           $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }
      else if(selectedOption == "phone"){
        $("#student-input").attr("placeholder", "Enter Student Mobile Number");

        $("#student-input").addClass("student-input-search");
        $("#input-class-col").removeClass("d-none");

        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }
      else if(selectedOption == "email"){
        $("#student-input").attr("placeholder", "Enter Student Email");

        $("#student-input").addClass("student-input-search");
        $("#input-class-col").removeClass("d-none");

        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }
      else if(selectedOption == "id"){
        $("#student-input").attr("placeholder", "Enter Student Id");

        $("#student-input").addClass("student-input-search");
        $("#input-class-col").removeClass("d-none");

        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }

      else if(selectedOption == "parents_id"){
        $("#student-input").attr("placeholder", "Enter Prarent Id");

        $("#student-input").addClass("student-input-search");
        $("#input-class-col").removeClass("d-none");

        $("#class-select").removeClass("student-input-search");
        $("#select-class-col").addClass("d-none");

        $("#hostel-select").removeClass("student-input-search");
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").addClass('d-none');

      }

     
      else if(selectedOption == "admission_date"){
    
        $("#input-class-col").addClass("d-none");
 
        $("#select-class-col").addClass("d-none");
 
        $("#select-hostel-col").addClass("d-none");

        $(".admission-class-col").removeClass('d-none');
 
        $('.search-btn').click();
 
      }

 
    });
  });
  