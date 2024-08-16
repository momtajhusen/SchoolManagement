//All Admit Parents Select Option 
$(document).ready(function(){
    $.ajax({
        url: "/get-all-admit-parents",
        method: 'GET',
        beforeSend: function() 
        {
            $('.load-box').html(`
               <span>please wait parents load <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i></span>
            `);
        },
         // Success 
        success:function(response)
        {

            console.log(response);
            $(".admit-parents-select").html('');
            $(".admit-parents-select").append('<option value="">Select Parent</option>');
            
            response.parentsData.forEach(function(parent) {
                // alert(parent.parents_id);
                $(".admit-parents-select").append(`
                    <option value="${parent.parent_id}">${'pr_id: '+parent.parent_id+' &nbsp&nbsp&nbsp '+'father: '+parent.father_name+' &nbsp&nbsp&nbsp '+'mother: '+parent.mother_name}</option>
                `);
            });

            $('.load-box').html('');
  
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});
