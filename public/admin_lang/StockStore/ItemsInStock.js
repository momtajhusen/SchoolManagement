// Add Items In Stock 
$(document).ready(function(){
    $(".items-in-stock-form").on("submit", function(e){
       e.preventDefault();

       $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    var formData = new FormData(this);
    $.ajax({
        url: "/admin/add-items-in-stock",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        // Success
        success: function (response) {

            if (response.status == "Add Success") {
                GetItemsAddStockHistory();
                $(".items-in-stock-form").trigger("reset");
                Swal.fire({
                    title: "Stock Add Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                    });
            } 
            
            if (response.status == "Item already exists") {
                Swal.fire(
                    "Already Stock exists !",
                    "Change Stock Name !",
                    "info"
                );
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
    
    });
});
 
// Retrive GetItemsAddStockHistory 
GetItemsAddStockHistory();
function GetItemsAddStockHistory(){

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $.ajax({
        url: "/admin/get-items-add-history",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);
 
            $(".stock-history-table").html('');
            if (response.Data.length > 0) {
              
                for (var i = 0; i < response.Data.length; i++) {
                    var item = response.Data[i];

                    $(".stock-history-table").append(`
                       <tr>
                            <td>`+i+`</td>
                            <td>`+item.items+`</td>
                            <td>`+item.quantity+`</td>
                            <td>`+item.categories+`</td>
                            <td>`+item.date+`</td>
                          <td>
                          <div class="dropdown d-none">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="flaticon-more-button-of-three-dots"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item edit-history" history_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                  <a class="dropdown-item delete-history" history_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i>Delete</a>
                              </div>
                          </div>
                      </td>
                       </tr>
                    `);

                }
            } else {
                // Handle the case when no data is found
                $('#tableContainer').html('<p>Data not found</p>');
            }
        },
        
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
}

GetStockItems();
function GetStockItems(){

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $.ajax({
        url: "/admin/get-items-in-stock",
        method: "GET",
        // Success
        success: function(response) {
            if (response.ItemsInStock) {
                // Assuming response.Data is an array of grouped items
    
                // Clear existing content
                $(".itemsstock").empty();
    
                // Iterate through the grouped items and append to the list
                $.each(response.ItemsInStock, function(category, items) {
                    // Append category span
                    $(".itemsstock").append('<span>' + category + '</span>');
    
                    // Iterate through items in the category and append list items
                    $.each(items, function(index, item) {
                        $(".itemsstock").append(`
                            <div class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span>` + item.items + `</span>
                            <span>` + item.stock + `</span>
                            </div>
                        `);
                    });
                });
            } else {
                // Handle the case where no data is found
                $(".itemsstock").html('<span>Data not found</span>');
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
}