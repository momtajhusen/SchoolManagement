
// Add New Items 
$(document).ready(function(){
  
   $('.add-items-btn').click(function(){

    var items_select = $('#items-options').html();

     var last_items_select =  $('.items-body-table').find('tr:last').find('.select-items').val();

     if(last_items_select == ''){
        $('.items-body-table').find('tr:last').find('.item-alert-message').html('Select this 👆 items');
        setTimeout(function(){
          $('.item-alert-message').html('');
        },2000);
        return false;
     }

 

       $('.items-body-table').append(`
       <tr>
            <th scope="row">1</th>
            <td>
              <div class="d-flex flex-column">
                <select class="select2 select-items" style="height:50px;width:200px; padding:10px; background:#f8f8f8; outline: none; border:none;">
                    `+items_select+`
                </select>
                <span class='item-alert-message'></span>
              </div>
            </td>
            <td class="text-center pt-4">₹ <span class="item-price">0</span></td>
            <td>
                <div class="form-group">
                    <input type="number" required  class="form-control item-quantity" value="0" min="1" style="width:80px;">
                </div>
            </td>
            <td class="text-center pt-4">₹ <span class="item-amount">0</span></td>
            <td class="text-center pt-4">
                <span class="material-symbols-outlined font-weight-bolder border remove-items" style='cursor:pointer'>remove</span>
            </td>
        </tr>
       `);

       total_amount();
   });
});

// Items Remove 
$(document).ready(function(){
    $('.items-body-table').on('click', '.remove-items', function(){
        $(this).parent().parent().remove();

        total_amount();
    });


 });

// Items On Change 
 $(document).ready(function(){
    $('.items-body-table').on('change', '.select-items', function(){
        // Access the price attribute of the selected option
        var items_price = $(this).find('option:selected').attr('price');

        // Update the item price cell
        $(this).parent().parent().parent().find('.item-amount').html(items_price);
        $(this).parent().parent().parent().find('.item-price').html(items_price);
        $(this).parent().parent().parent().find('.item-quantity').val(1);

        total_amount();

    });
});

// Quantity On Input 
$(document).ready(function(){
    $('.items-body-table').on('input', '.item-quantity', function(){

 
        // Access the price attribute of the selected option
        var items_price = $(this).parent().parent().parent().find('option:selected').attr('price');

        var items_quantity = $(this).val();

        var items_qty_price = Number(items_quantity) * Number(items_price);

        // Update the item price cell
        $(this).parent().parent().parent().find('.item-amount').html(items_qty_price);

        $(this).parent().parent().parent().find('.item-price').html(items_price);

        total_amount();

    });
});

// Total Amount 
function total_amount(){
    var all_items_price = 0;
    var total_qauantity = 0;
    $('.item-amount').each(function(){
        all_items_price += Number($(this).html());
    });
    $('.total-amount').html('₹ '+all_items_price);

    $('.item-quantity').each(function(){
        total_qauantity += Number($(this).val());
    });
    $('.total-amount').html('₹ '+all_items_price);


    var itemCount = $('.item-amount').length;
    $('.total-items-count').html(itemCount);

    $('.total-qauantity-count').html(total_qauantity)


}

// Billing 
var itemsArray = []; 
$(document).on('click', '.billing-sell-item', function() {

   itemsArray = []; 


    if($('.search-select').val() == ''){
        alert('Select Student');
        return false;
    }

    var last_items_select =  $('.items-body-table').find('tr:last').find('.select-items').val();

    if(last_items_select == ''){
       $('.items-body-table').find('tr:last').find('.item-alert-message').html('Select this 👆 items');
       setTimeout(function(){
         $('.item-alert-message').html('');
       },2000);
       return false;
    }

    $('.items-body-table').find('tr').each(function() {
        var item = {};
        
        // Get selected item text
        item.itemName = $(this).find('.select-items option:selected').text();
        
        // Get item quantity
        item.quantity = parseInt($(this).find('.item-quantity').val());
        
        // Get item amount
        item.amount = parseInt($(this).find('.item-amount').text());
        
        // Push the item object into the array
        itemsArray.push(item);
    });
 
    $('.item-particular-table').html('');
    var totalAmount = 0;
    itemsArray.forEach((element, index) => {
        totalAmount += element.amount;
        $('.item-particular-table').append(`
            <tr>
                <th>${index + 1}</th>
                <td>${element.itemName}</td>
                <td>${element.quantity}</td>
                <td>₹ ${element.amount}</td>
            </tr>
        `);
    });

    $('.total-amount-items').html('₹ '+totalAmount);

    $('#fee_input').val(totalAmount);
    $('#paid_input').val(totalAmount);
    
    $('#feePaymentModal').modal('show');

});

 // Payment 
$(document).ready(function(){
    $('.paid_btn').click(function(){

         var fee_input = $('#fee_input').val();
         var paid_input = $('#paid_input').val();
         var dues_input = $('#dues_input').val();
         var percentage = $('#percentage').val();
         var disc_input = $('#disc_input').val();
         var pay_date = $('#pay_date').val();
         var comment_disc = $('#comment_disc').val();

         var st_id = $('.admit-students-select option:selected').attr('st_id');
 
         var particularJsonData = JSON.stringify(itemsArray);

         $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            url: "/admin/sell-items",
            method: "POST",
            data: {
                fee_input:fee_input,
                paid_input:paid_input,
                dues_input:dues_input,
                percentage:percentage,
                disc_input:disc_input,
                pay_date:pay_date,
                comment_disc:comment_disc,
                st_id:st_id,
                particular_data:particularJsonData,
                current_year:current_year,
            },
            beforeSend: function() 
            {
             // setting a timeout
               $(".monthly_payment").addClass('d-none');
               $("#payment-loading").removeClass('d-none');
            },
            // Success
            success: function (response) {

                console.log(response);

                if(response.status == 'sell success'){
                    Swal.fire(
                        "Payment Success !",
                        "If any dues then add on account !", // Alert message
                        "success" // Alert type
                    ).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            // Reload the page
                            // location.reload();
                        }
                    });

                  $('#feePaymentModal').modal('hide');
                    
                }else{
                    alert(response);
                }

                GetStockItems();
                RetriveHistory();

 

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});

// Paid Oninput Condition  
$(document).ready(function () {
    $("#paid_input").on("input", function (e) {
        var ActualDues = Number($("#fee_input").val());
        var discount = Number($("#disc_input").val());
        var payment = Number($(this).val());
        
        if (payment < 0) {
            $(this).val(0);
            payment = 0; // Update payment value
        }

        if (ActualDues < payment) {
            $("#paid_input").val(ActualDues);
            $("#percentage").val(0);
            $("#disc_input").val(0);
            $("#comment_for_discount").addClass("d-none");
            payment = ActualDues; // Update payment value
        }

        // Calculate and update dues
        var newDues = ActualDues - payment;
        $("#dues_input").val(newDues - discount);

    });

    $("input[type='number']").on("keypress", function (e) {
        if (e.key === "+" || e.key === "-" || e.key === "e") {
            e.preventDefault();
        }
    });
});

// Saving Oninput Condition
$(document).ready(function () {
    $("#disc_input").on("input", function (e) {
    
    var ActualDues = Number($("#fee_input").val());
    var discount = Number($("#disc_input").val());
    
    var AfterDiscuntPay = ActualDues - discount;
    $("#paid_input").val(AfterDiscuntPay);
    
        if(discount <= 0){
        $("#paid_input").val(ActualDues);
        $("#percentage").val(0);
        $(this).val(0);
        return false;
        }
    
        var percentage = (discount / ActualDues * 100).toFixed(3);
        $("#percentage").val(percentage);
    
        if(discount >= ActualDues){
        $(this).val(ActualDues);
        $("#percentage").val(100);
        $("#paid_input").val(0);
        }
    
    });
    
    $("input[type='number']").on("keypress", function (e) {
        if (e.key === "+" || e.key === "-" || e.key === "e" || e.key === ".") {
            e.preventDefault();
        }
    });
});

$(document).ready(function(){

    $("#disc_input,#percentage").on("input",function()
    {  
        if ($(this).val()) {
            // Check if there are leading zeros followed by non-zero digits and remove them
            let inputValue = $(this).val().replace(/^0+(?=[1-9])/, '');
        
            // Set the value to '100' if it's empty
            $(this).val(inputValue || 100);
        }
    });
});

// Percentage Oninput Condition
$(document).ready(function(){
    $("#percentage").on("input", function(e){
        var percentage = $(this).val();
        var ActualDues = Number($("#fee_input").val());

        if(percentage < 0){
            $(this).val(0);
            return false;
        }

        if(percentage > 100){
            $(this).val(100);
            $("#paid_input").val(0);
            $("#disc_input").val(ActualDues);
            return false;
        }

        var discountAmount  = ActualDues / 100 * percentage;
            
        $("#disc_input").val(discountAmount);

        $("#paid_input").val(ActualDues - discountAmount);
        
    })
});

// Discount Comment input display 
$(document).ready(function () {
    $('#percentage, #disc_input').on('input', function () {
    var percentage = $('#disc_input').val();
    $("#dues_input").val(0);

        if(percentage > 0){
        $("#comment_for_discount").removeClass("d-none");
        }

        if(percentage <= 0){
        $("#comment_for_discount").addClass("d-none");
        }
    });
});

$(document).ready(function () {
    $('#percentage').on('keydown', function (e) {
    if (e.keyCode === 190 || e.keyCode === 110) {
        e.preventDefault();
    }
    });
});
