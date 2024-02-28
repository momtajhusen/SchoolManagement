// Save User Route 
$(document).ready(function(){
    $(".save-route-user").click(function(){

        var routesdata = [];

        $(".route-checked").each(function(){
            var isChecked = $(this).prop("checked");
            if(isChecked){
                var route = $(this).attr('route');
                var category = $(this).attr('category');

                routesdata.push({ route: route, category: category });

            }
        });
        
        var name = $("[name='name']").val();
        var number = $("[name='number']").val();
        var gmail = $("[name='email']").val();
        var password = $("[name='password']").val();
        
        var userData = {
            routes: routesdata,
            user: {
                name: name,
                number: number,
                email: gmail,
                psd: password
            }
        };

         $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/user-routes-save",
            method: "POST",
            data: JSON.stringify(userData), 
            contentType: 'application/json',
            // Success
            success: function (response) 
            {
                console.log(response);
                
                if(response.message == "Update Successfully"){
                    Swal.fire({
                        title: 'Update Success',
                        text: "user data and route update success",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
  
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            }
        });
    });
});


// checked for update 
$(document).ready(function(){

    // Get the current URL
    var currentUrl = window.location.href;
    var urlParts = currentUrl.split("/");
    var routeId = urlParts[urlParts.length - 1];

    if (!isNaN(routeId)) {
        routeId = routeId;
    } else {
        routeId = 'new'
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/admin/get-subadmin-details",
        method: "GET",
        data: {
            admin_id: routeId,
        },
        // Success
        success: function (response) 
        {
            console.log(response);
         
            if(response.UserData){
               $("[name='name']").val(response.UserData.name);
               $("[name='email']").val(response.UserData.email);
               $("[name='number']").val(response.UserData.number);
               $("[name='password']").val(response.UserData.password);
            }

            if(response.RoutesData){

                $(".route-checked").each(function(){
                    var CheckInput = $(this);
                    var checkedurl = $(this).attr('route');
                    var matched = false;
    
                    response.RoutesData.forEach(route => {
                        if (route === checkedurl) {
                            matched = true;
                        }
                    });

                    if (matched) {
                        CheckInput.prop("checked", true);
                    } else {
                        CheckInput.prop("checked", false);
                    }
                   
                });
            }




        

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        }
    });

});