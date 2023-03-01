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

                $(".roll-select").html(``);
                $(".roll-select").append(`<option value="">Select Roll</option>`);
                var count = 1;
                response.classrolls.forEach(function(data){
                 var index = count++;
                    $(".roll-select").append(`
                        <option value="`+index+`">`+index+`</option>
                    `);
                });
    
            }
        });
    });



});
