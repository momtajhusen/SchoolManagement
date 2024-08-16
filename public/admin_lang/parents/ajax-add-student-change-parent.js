$(document).ready(function(){
 
    $('.add-student').click(function(){
 
          $("#exampleModal").modal('show');

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    //    var parent_id = $('#parent-id').val();

    //    alert(parent_id);
      
        $.ajax({
            url:  '/get-all-admit-student',
            method: 'GET',
            beforeSend: function() 
            {
                $('.all-student').html(`
                  <tr>
                     <td colspan='6'><center>please wait students load <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i></center></td>
                  </tr>
                `);
            },
            // Success 
            success:function(response)
            {
                $('.all-student').html('');
                response.studentsData.forEach(element => {
                 $('.all-student').append(`
                    <tr>
                        <th scope="row">
                           <span id='student-add' pr_id='${element.parent_id}' st_id='${element.student_id}' class="material-symbols-outlined ml-2 border" style="cursor: pointer;">add</span>
                        </th>
                        <td> <img class="border p-1 hover-image-preview" src="/storage/`+element.student_img+`" alt="student" style="width:40px;" /></td>
                        <td nowrap="nowrap">${element.student_name}</td>
                        <td nowrap="nowrap">${element.student_id}</td>
                        <td nowrap="nowrap">${element.class} ${element.section}</td>
                        <td nowrap="nowrap">${element.father_name}</td>
                    </tr>
                 `);
              });


                console.log(response);

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });


    });
});

$(document).ready(function(){
    $(".all-student").on("click", "#student-add", function()
    {  
         var pr_id = $('#parent-id').val();
         var st_id = $(this).attr('st_id');

         if(pr_id == undefined){
            alert('provide pr_id');
            return false;
         }

         if(pr_id == ''){
            alert('provide pr_id');
            return false;
         }

         if(st_id == ''){
            alert('provide st_id');
            return false;
         }

         
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:  '/change-parent',
            method: 'POST',
            data:{
                pr_id:pr_id,
                st_id:st_id,
            },
            // Success 
            success:function(response)
            {

                // alert(response);
 
                if(response == 'change sucess'){
                    $('.modal-close-btn').click();
                    Swal.fire({
                        title: 'Add Success',
                        text: "student add on this parent",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Auto reload the page after the SweetAlert timer ends
                        location.reload();
                    });
                }

                console.log(response);

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });


 
    });
});