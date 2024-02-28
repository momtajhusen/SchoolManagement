// class option retrive in in select after page open
$(document).ready(function(){
 
    $(".class-select").change(function(){

       var classvalue = $(this).val();
       var year = NepaliFunctions.GetCurrentBsDate().year;
       
       
        $.ajax({
            url: "/get-class-roll",
            method: 'GET',
             data:{
                class:classvalue,
                year : year,
             },
            success:function(response)
            {
                console.log(response);

                $(".roll-select").html(``);
                $(".roll-select").append(`<option value="">Select Roll</option>`);
                var count = 0;
                response.classrolls.forEach(function(data){
                 var index = count++;
                    $(".roll-select").append(`
                        <option value="`+data.roll_no+`" stid='`+data.id+`'>`+data.roll_no+": "+data.first_name+" "+data.middle_name+" "+data.last_name+`</option>
                    `);
                });
    
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });



});
