// Retrive All Student
  $(document).ready(function(){
    RegistrationStudent();
 });

 function RegistrationStudent(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "/get-registration-list",
        method: 'GET',
         // Success 
         success:function(response)
         {

            console.log(response.data);
 
            $(".table-body").html(` `);
            if(response.data){
                var count = 0;
                var index = 1;
             response.data.forEach(function(data){

              var increase = count++
              var sn = index++;
              var id = data.id;
              var student_image = data.student_image;
              var first_name = data.first_name;
              var middle_name = data.middle_name;
              var last_name = data.last_name;
              var gender = data.gender;
              var dob = data.dob;
              var phone = data.phone;
              var village = data.village;
              var municipality = data.municipality;
              var district = data.district;
              var ward_no = data.ward_no;
              var classes = data.class;
              var section = data.section;
              var roll_no = data.roll_no;




              var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

               //   Parents Data 
               var father_name =  data.father_name;
               var father_contact =  data.father_contact;
               
               var studentImageWithCacheBust = currentDomainWithProtocol + "/storage/" + student_image + "?timestamp=" + new Date().getTime();


              $(".table-body").append(`  
              <tr>
                <td class="text-center"><a href="student-details/`+id+`"><img src="`+studentImageWithCacheBust+`" alt="student" style="height:40px;padding:2px;border:1px solid  #ccc;"></a></td>
                <td><a  href="student-details/`+id+`" class="text-dark">`+first_name+` `+middle_name+` `+last_name+`</a></td>
                <td>`+gender+`</td>
                <td>`+classes+`</td>
                <td>`+roll_no+`</td>
                <td>`+section+`</td>
                <td>`+father_name+`</td>
                <td>`+father_contact+`</td>
                <td>`+village+` `+ward_no+`, `+municipality+`, `+district+` </td>
                <td>
                    <button class='border btn bg-none border-success border-2' st_id='`+id+`' id='conform-btn'>Conform</button>
                    <button class='border btn bg-none border-danger border-2' st_id='`+id+`' id='student-delete'>Delete</button>

                </td>
             </tr>
            `);
             });
            }
 

          

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });
 }

// Single Conform Registration
 $(".table-body").on("click", "#conform-btn", function()
 { 
    
    Swal.fire({
        title: 'Are you sure  conform?',
        text: "Please note that conform student will data save.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, conform it!'
      }).then((result) => {
        if (result.isConfirmed) {
    
            var st_id = $(this).attr('st_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:  "/registration-conform",
                method: 'POST',
                data:{
                st_id:st_id,
                },
                // Success 
                success:function(response)
                {
                if(response.message == 'conform sucess'){
                    Swal.fire({
                        title: 'Conform Success',
                        text: "Student data has been conform",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        RegistrationStudent();
                    });
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

 // All Conform Registration
$(document).ready(function(){
    $('.all-conform-btn').click(function(){

        Swal.fire({
            title: 'Are you sure  conform all student?',
            text: "Please note that conform all student data save.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, conform it!'
          }).then((result) => {
            if (result.isConfirmed) {
        
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    url:  "/all-registration-conform",
                    method: 'POST',
                    // Success 
                    success:function(response)
                    {
                    if(response.message == 'conform sucess'){
                        Swal.fire({
                            title: 'All Student Conform Success',
                            text: "All Student Data has been conform",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            RegistrationStudent();
                        });
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
});

// All Delete Registration
$(document).ready(function(){
    $('.all-delete-btn').click(function(){

        Swal.fire({
            title: 'Are you sure  delete all student?',
            text: "Please note that delete all student data delete.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
        
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    url:  "/all-registration-delete",
                    method: 'POST',
                    // Success 
                    success:function(response)
                    {
                    if(response.message == 'delete sucess'){
                        Swal.fire({
                            title: 'All Student delete Success',
                            text: "All Student Data has been delete",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            RegistrationStudent();
                        });
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
});

 


 