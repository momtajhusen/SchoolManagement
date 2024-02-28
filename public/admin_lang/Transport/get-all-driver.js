// class option retrive in in select after page open
$(document).ready(function(){
 
 
    $.ajax({
        url: "/get-all-driver",
        method: 'GET',
         // Success 
        success:function(response)
        {

            console.log(response);
            
            $(".driver-select").html(``);
            $(".driver-select").append(`<option value="">Select Driver</option>`);
            var count = 0;
            response.data.forEach(function(data){
            var index = count++;
                $(".driver-select").append(`
                  <option value="`+response.data[index].id+`">`+response.data[index].first_name+" "+response.data[index].last_name+`</option>
                `);
            });

        },
        error: function (xhr, status, error) 
        {
            console.log(JSON.parse(xhr.responseText));
        },
    });

});

 