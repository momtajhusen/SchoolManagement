$(document).ready(function(){
    $(".student-select").on("change", function(){

        var pr_id = $(this).find(':selected').attr('pr_id');

        $.ajax({
            url: "/student-payment-fee-retrive",
            method: 'GET',
            data:{
                pr_id:pr_id
            },
             // Success 
            success:function(response)
            {
 
              console.log(response);

              if(response.status == 'success')
              {
                $(".parent-details-box").removeClass('d-none');
                $(".student-search-box").addClass('d-none');

                var father_img = response.parent_details.father_image;
                var father_name = response.parent_details.father_name;
                var father_contact = response.parent_details.father_mobile;

                var ward_no = response.student_details[0].ward_no;
                var village = response.student_details[0].village;
                var municipality = response.student_details[0].municipality;

                $(".total-children").html(response.student_details.length);

                $('.parent-image').attr('src','../storage/'+father_img+'');
                $('.father-name').html(father_name);
                $('.father-contact').html(father_contact);
                $('.father-address').html(village+', '+municipality);

                if(response.student_details)
                {
                    $(".students-table").html(''); 
                    response.student_details.forEach(element => {
                        var student_name = element.first_name+' '+element.last_name;
                        $(".students-table").append(`
                            <tr>
                                <td>
                                   <img class="border p-1 parent-image" src="../storage/`+element.student_image+`" alt="parent" style="width:40px;">
                                   <span>`+student_name+`</span>
                                </td>
                                <td>`+element.id+`</td>
                                <td>`+element.total_fee+`</td>
                                <td>`+element.total_paid+`</td>
                                <td>`+element.total_dues+`</td>
                            </tr>
                        `); 
                    });

                    $(".students-table").append(`
                        <tr class='bg-secondary text-light'>
                            <td colspan='2' class='text-center'>Total</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td class='bg-light'><button class='bg-info btn w-100 h-100 text-light'>Payment</button></td>
                        </tr>
                   `); 
                }

              }

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
       
    });
 });
 

$(document).ready(function(){
    $(".parent-search-icon").click(function(){
        $(".parent-details-box").addClass('d-none');
        $(".student-search-box").removeClass('d-none');
        $(".students-table").html(''); 
    });
});

// select-option choose 
$(document).ready(function(){
    $('.select-option').each(function(){

        $('.select-option').click(function(){

           $('.select-option').removeClass('selected-option');

            $(this).addClass('selected-option');
        });
    });
});
 