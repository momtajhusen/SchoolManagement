//All Admit Parents Select Option 
$(document).ready(function(){
    $.ajax({
        url: "/get-all-admit-parents",
        method: 'GET',
         // Success 
        success:function(response)
        {
            console.log(response);
            $(".admit-parents-select").html('');
            $(".admit-parents-select").append('<option value="">Select Parent</option>');
            
            response.parentsData.forEach(function(parent) {
                // alert(parent.parents_id);
                $(".admit-parents-select").append(`
                    <option value="${parent.parent_id}">${'id: '+parent.parent_id+' '+'name: '+parent.parent_name}</option>
                `);
            });
            
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});
