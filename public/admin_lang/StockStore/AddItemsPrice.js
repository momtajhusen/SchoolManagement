
// Add Items 
$(document).ready(function(){
    $(".added-items-form").submit(function (e) {
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
            url: "/admin/add-items",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {
                if (response.status == "Add Success") {
                    GetAllItems();
                    $(".select-category").val('');
                    $(".added-items-form").trigger("reset");
                    Swal.fire({
                        title: "Items Add Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                        });
                } 
                
                if (response.status == "Item already exists") {
                    Swal.fire(
                        "Already Items exists !",
                        "Change Items Name !",
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

// Get All Items
$(document).ready(function(){
    GetAllItems();
});

function GetAllItems(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $(".items-table").html('');
    $.ajax({
        url: "/admin/get-all-items",
        method: "GET",
        // Success
        success: function (response) {

            if (response.Data.length > 0) {

                for (var i = 0; i < response.Data.length; i++) {
                    var item = response.Data[i]; 
                    $(".items-table").append(`
                       <tr>
                          <td>`+i+`</td>
                          <td>`+item.items+`</td>
                          <td>`+item.price+`</td>
                          <td>`+item.categories+`</td>
                          <td>
                          <div class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="flaticon-more-button-of-three-dots"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item edit-item d-none" item_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                  <a class="dropdown-item delete-item" item_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i>Delete</a>
                              </div>
                          </div>
                      </td>
                       </tr>
                    `);

                    $(".select-items").append(`
                      <option class="class-option" value="`+item.items+`">`+item.items+`</option>
                    `);
                }
            } else {
                $('.items-table').html('<p>Data not found</p>');
            }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
}

// Delete Items 
$(document).ready(function () {

    $(".items-table").on("click", ".delete-item", function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var item_id = $(this).attr("item_id");

        $.ajax({
            url: "/admin/delete-item",
            method: "POST",
            data: {
                item_id: item_id,
            },
            // Success
            success: function (response) {

                if (response.status = "Delete Success") {
                    GetAllItems();
                    Swal.fire(
                        "Category Delete Success !",
                        "You clicked the button!",
                        "success"
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
