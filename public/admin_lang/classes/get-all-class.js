// class option retrive in in select after page open
$(document).ready(function(){
 
    $.ajax({
        url: "/get-all-class",
        method: 'GET',
         // Success 
        success:function(response)
        {

            $(".class-select").html(``);
            $(".class-select").append(`<option value="">Select Class</option>`);
            var count = 0;
            response.data.forEach(function(data){
            var index = count++;
                $(".class-select").append(`
                  <option value="`+response.data[index].class+`">`+response.data[index].class+`</option>
                `);
            });

        }
    });

});
