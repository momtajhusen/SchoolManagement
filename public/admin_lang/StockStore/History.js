
// Retrive History 
RetriveHistory();
function RetriveHistory(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

        
    $.ajax({
        url: "/get-inventory-purchase-history",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);
            $('.history-body-table').html('');
            var length = response.purchaseHistory.length;
            response.purchaseHistory.forEach(element => {
                var sn = length--;

                var particularArray = JSON.parse(element.particulars_data);

                var particular = '';
                particularArray.forEach(element => {
                    particular +=  element.itemName+' - ₹ '+element.amount+'<br>';
                });

                console.log(particularArray);

                var status_color = '';
                if(element.dues != 0){
                   if(element.add_month_status != 'Paid'){
                    status_color = 'text-danger';
                   }
                }


             $('.history-body-table').append(`
                <tr>
                    <td>${sn}</td>
                    <td>${element.st_id}</td>
                    <td>${element.student_name}</td>
                    <td>${particular}</td>
                    <td>₹ ${element.amount}</td>
                    <td>₹ ${element.paid}</td>
                    <td class='`+status_color+`'>₹ ${element.dues}</td>
                    <td>
                        <span class="material-symbols-outlined border p-2 reset_history" hs_id='${element.id}' style="cursor:pointer">restart_alt</span>
                        <span class="material-symbols-outlined border p-2 invoice_history" hs_id='${element.id}' style="cursor:pointer">description</span>
                    </td>
                </tr>
             `);
 
           });
        },
        
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
} 

// Reset History 
$(document).ready(function(){

    $('.history-body-table').on('click', '.reset_history', function(){

       var hs_id =  $(this).attr('hs_id');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

                
    $.ajax({
        url: "/purchase-history-reset",
        method: "POST",
        data:{
            hs_id:hs_id
        },
        // Success
        success: function (response) {
 
            alert(response.status);

            RetriveHistory();
 
        },
        
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
    
    })
 
});
