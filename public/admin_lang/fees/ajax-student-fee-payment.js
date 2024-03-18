//  Search icon 
$(document).ready(function(){
    $(".parent-search-icon").click(function(){
        $(".parent-details-box").addClass('d-none');
        $(".student-search-box").removeClass('d-none');
        $(".students-table").html(''); 
    });
});

// select-option choose 
$(document).ready(function(){
    $('.select-option').click(function(){
        $('.select-option').removeClass('selected-option');
        $(this).addClass('selected-option');

        if($(this).html() == 'Students'){
            $(".student-select-box").removeClass('d-none');
            $(".parent-select-box").addClass('d-none');
            $('.admit-parents-select').trigger('click');

        }
        if($(this).html() == 'Parents'){
            $(".student-select-box").addClass('d-none');
            $(".parent-select-box").removeClass('d-none');
        }
    });

    $('.select-option:first').trigger('click');
});


// Select parent than retrive stundets 
$(document).ready(function(){
    $(".search-select").on("change", function(){

       var pr_id = $(this).val();

        $.ajax({
            url: "/parent-student-retrive",
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

                var pr_id = response.parent_details.id;
                var father_img = response.parent_details.father_image;
                var father_name = response.parent_details.father_name;
                var father_contact = response.parent_details.father_mobile;

                var ward_no = response.student_details[0].ward_no;
                var village = response.student_details[0].village;
                var municipality = response.student_details[0].municipality;

                $(".total-children").html(response.student_details.length);

                $('.pr-id').html(pr_id);
                $('.parent-image').attr('src','../storage/'+father_img+'');
                $('.father-name').html(father_name);
                $('.father-contact').html(father_contact);
                $('.father-address').html(village);

                if(response.student_details)
                {
                    $(".students-table").html(''); 
                    response.student_details.forEach(element => {
                        var student_name = element.first_name+' '+element.last_name;
                        $(".students-table").append(`
                            <tr class='students' st_id='`+element.id+`' style='cursor:pointer'>
                                <td>
                                   <img class="border p-1 parent-image" src="../storage/`+element.student_image+`" alt="parent" style="width:40px;">
                                   <span>`+student_name+`</span>
                                </td>
                                <td class='text-center'>`+element.id+`</td>
                                <td class='text-center'>`+element.total_fee+`</td>
                                <td class='text-center'>`+element.total_paid+`</td>
                                <td class='text-center'>`+element.total_dues+`</td>
                            </tr>
                        `); 
                    });

                    $(".students-table").append(`
                        <tr class='bg-secondary text-light'>
                            <td colspan='2' class='text-center'>Total</td>
                            <td class='text-center'>00</td>
                            <td class='text-center'>00</td>
                            <td class='text-center'>00</td>
                            <td class='bg-light p-0 d-none'><button class='bg-info btn w-100 h-100 text-light py-3'>Payment</button></td>
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

//  Selected student get fee months 
$(document).ready(function(){
    $(".students-table").on("click", ".students", function(){  

        var st_id = $(this).attr('st_id');

        $.ajax({
            url: "/student-fee-retrive",
            method: 'GET',
            data:{
                st_id:st_id
            },
             // Success 
            success:function(response)
            {
              console.log(response);

              if(response.status == 'success'){
                $('.students-fee-table').html('');
                response.fee_month.forEach((element, index) => {

                     $('.students-fee-table').append(`
                        <tr class='text-center'>
                            <td>`+NepaliFunctions.GetBsMonth(index)+`</td>
                            <td>`+element+`</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td><button class="bg-danger border-0 text-light rounded px-4 btn">unpaid</button></td>
                            <td><button class="bg-info take-pay border-0 text-light btn rounded p-2 px-4" style="cursor:pointer">Payment</button></td>
                            <td>
                                <div class="form-check justify-content-center d-flex">
                                  <input type="checkbox" class="form-check-input" id="check_${index}">
                                  <label class="form-check-label" for="check_${index}" style="cursor:pointer;"></label>
                                </div>
                            </td>
                        </tr>
                     `);
                 });
              }
             
            },
            error: function (xhr, status, error) 
            {
                // console.log(xhr.status);
                $('.students-fee-table').html('');
                if(xhr.status == 404){
                    $('.students-fee-table').append(`
                        <tr>
                            <td colspan='8' class='py-3 px-3'><span>No fee structures set this student</sapn></td>
                        </tr>
                    `);
                }
                console.log(xhr.responseText);
            },
        });

    });
});



 