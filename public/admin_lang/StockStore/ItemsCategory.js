// Add Category 
$(document).ready(function () {
    $(".added-item-category-form").submit(function (e) {
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
                url: "/add-items-category",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                // Success
                success: function (response) {
                    if (response.status == "Add Success") {
                        GetCategoryData();
                        $(".added-item-category-form").trigger("reset");
                        Swal.fire({
                            title: "Subject Add Success !",
                            text: "You clicked the button!",
                            icon: "success",
                            confirmButtonText: "OK",
                            });
                    } 
                    
                    if (response.status == "exists category") {
                        Swal.fire(
                            "Already Category exists !",
                            "Change Category Name !",
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

// Retrive Category 
$(document).ready(function () {
    GetCategoryData();
});
function GetCategoryData(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $(".select-category").html(`<option value="">Select Categories</option>`);
    $(".category-table").html('');
    $.ajax({
        url: "/get-items-all-category",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);
        
            if (response.Data.length > 0) {

                for (var i = 0; i < response.Data.length; i++) {
                    var item = response.Data[i];
                    $(".category-table").append(`
                       <tr>
                          <td>`+i+`</td>
                          <td>`+item.categories+`</td>
                          <td>
                          <div class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="flaticon-more-button-of-three-dots"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item edit-category d-none" category_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                  <a class="dropdown-item delete-category" category_id="` + item.id + `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i>Delete</a>
                              </div>
                          </div>
                      </td>
                       </tr>
                    `);

                    $(".select-category").append(`
                      <option class="class-option" value="`+item.categories+`">`+item.categories+`</option>
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

$(document).ready(function(){
    $('#categoryOnChangeItems').on("change", function(){

        var category = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            url: "/get-items-category-change",
            method: "GET",
            data:{
                category:category 
            },
            // Success
            success: function (response) {
                console.log(response);
            
                $(".category-change-items").empty();
                if (response.Data.length > 0) {
    
                    for (var i = 0; i < response.Data.length; i++) {
                        var item = response.Data[i];

                        $(".category-change-items").append(`
                          <option class="class-option" value="`+item.items+`">`+item.items+`</option>
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

    });

    // alert($('#category').val());
});

// Delete Category 
$(document).ready(function () {

    $(".category-table").on("click", ".delete-category", function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


        var category_id = $(this).attr("category_id");

        $.ajax({
            url: "/delete-category",
            method: "POST",
            data: {
                category_id: category_id,
            },
            // Success
            success: function (response) {

                if (response.status = "Delete Success") {
                    GetCategoryData();
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