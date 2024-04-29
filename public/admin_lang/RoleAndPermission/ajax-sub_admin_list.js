$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/admin/sub-admin-list",
        method: "get",
        contentType: 'application/json',
        // Success
        success: function (response) 
        {

            console.log(response);

            if(response.subAdminData){
                response.subAdminData.forEach(element => {
                $(".sub-admin-table").append(`
                    <tr>
                    <th scope="row">1</th>
                    <td>`+element.name+`</td>
                    <td>`+element.number+`</td>
                    <td>`+element.email+`</td>
                    <td>`+element.password+`</td>
                    <td>
                      <div class="d-flex">
                          <a href="role-permission-update/`+element.id+`" type="button" class="btn btn-primary mx-1">
                              <span>Edit Route</span>
                              <span class="material-symbols-outlined mt-1 px-2" style="font-size:10px;">edit_square</span>
                          </a>
                          <button href="sub-admin-delete/`+element.id+`" type="button" class="btn btn-danger d-flex flex-items-center">
                              <span>Delete User</span>
                              <span class="material-symbols-outlined mt-1 px-2" style="font-size:10px;">delete</span>
                          </button>
                      </div>
                    </td>
                  </tr>
                    `);
               });
            }
 
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        }
    });

});