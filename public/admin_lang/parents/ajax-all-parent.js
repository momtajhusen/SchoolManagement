// Retrive All parents
$(document).ready(function(){
    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    loadParentData(currentDomainWithProtocol+"/get-all-parents?page=1");

});

$(document).ready(function(){
    $(".search-parents").click(function(){
        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
        loadParentData(currentDomainWithProtocol+"/get-all-parents?page=1");
    });
 });

function loadParentData(url) {
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var parents_search_select =  $(".parents-search-select").val();
    var parents_input_search = $(".parents-input-search").val();


    $.ajax({
        url: url,
        method: 'GET',
        data:{
            parents_search_select : parents_search_select,
            parents_input_search : parents_input_search,
        },
         // Success 
         success:function(response)
         {

            console.log(response);

            // console.log(response.parent_data);

            // return false;
            
            $(".table-body").html(``);
            if (response.message !== "Parent data not found") {
                // Show pagination number
                var start = response.parent_data.from;
                var links = response.parent_data.links.length - 2;
                $(".result_no").html(response.parent_data.total);
            
                var i;
                var ul = document.createElement("UL");
                ul.className = "pagination";
                for (i = start; i <= links; i++) {
                    $(".pagnation-box").html("");
            
                    var li = document.createElement("LI");
                    li.className = "page-item";
                    $(ul).append(li);
            
                    var a = document.createElement("a");
                    a.className = "page-link";
                    a.innerHTML = i;
                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                    a.href = currentDomainWithProtocol + "/get-all-parents?page=" + i;
                    $(li).append(a);
            
                    // Get data on click
                    $(a).click(function (e) {
                        e.preventDefault();
                        loadParentData($(this).attr("href"));
                    });
                }
            
                if ($(".pagnation-box").html() == "") {
                    $(".pagnation-box").append(ul);
                }
            
                response.parent_data.data.forEach(function (data) {
                    var id = data.id;
                    var father_image = data.father_image;
                    var father_name = data.father_name;
                    var father_mobile = data.father_mobile;
                    var father_education = data.father_education;
                    var mother_image = data.mother_image;
                    var mother_name = data.mother_name;
                    var mother_mobile = data.mother_mobile;
                    var mother_education = data.mother_education;
                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                    var total_child = data.students.length;
                    

                    if(total_child != 0){
                        var delete_icon = "d-none"; 

                    }
                    else{
                        var delete_icon = "";
                    }
            
                    $(".table-body").append(`
                        <tr>
                            <td>${id}</td>
                            <td class="text-center"><a href="parent-profile/`+id+`"><img src="${currentDomainWithProtocol}/storage/${father_image}" style="height:40px; padding:2px;border:1px solid #ccc;" alt="father_img"></a></td>
                            <td><a href="#" class="text-dark">${father_name}</a></td>
                            <td>${total_child}</td>
                            <td>${father_mobile}</td>
                            <td>${mother_name}</td>
                            <td>${mother_mobile}</td>
                            <td>${mother_education}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item parent-edit" parent_id="${id}" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item parent-delete `+delete_icon+`" parent_id="${id}" href="#"><i class="fas fa-trash text-orange-peel"></i>Delete</a>
                                        <a href="parent-profile/`+id+`" class="dropdown-item parent-profile parent_id="${id}" href="#"><i class="fa fa-user text-orange-peel"></i>Profile</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `);
                });
            } else {
                $(".table-body").append(`
                    <tr>
                        <td colspan="8" class="text-center"><b>Parent data not found<b></td>
                    </tr>
                `);
            }
        

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });
}

$(document).ready(function() {
    $('.parents-search-select').change(function() {
      var selectedOption = $(this).val();
      $(".parents-input-search").val("");
      
      $(".parents-input-search").attr("placeholder", "Enter "+selectedOption);
 
    });
  });

// Edit Parent for Update 
$(document).ready(function(){
    $(".table-body").on("click", ".parent-edit", function () {

       var parent_id = $(this).attr("parent_id");
       $('input[name="parent_id"]').val(parent_id);
    
       $("#myModal").modal("show");

       $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
       });

       $.ajax({
        url: "/get-parent-data",
        method: "GET",
        data: {
            parent_id: parent_id,
        },
        
        // Success
        success: function (response) {
            console.log(response);
        //    alert(response.data.father_mobile);


           var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


           $("#father_img_preview").attr("src",currentDomainWithProtocol+`/storage/`+response.data.father_image);
           $('input[name="father_name"]').val(response.data.father_name);
           $('input[name="father_phone"]').val(response.data.father_mobile);
           $('input[name="father_email"]').val(response.data.login_email);
           $('input[name="father_education"]').val(response.data.father_education);

           $("#mother_img_preview").attr("src",currentDomainWithProtocol+`/storage/`+response.data.mother_image);
           $('input[name="mother_name"]').val(response.data.mother_name);
           $('input[name="mother_phone"]').val(response.data.mother_phone);
           $('input[name="mother_education"]').val(response.data.mother_education);


        },

        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });



    });
});

// parent-update-form
$(document).ready(function(){
    $(".parent-update-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var father_image_name = localStorage.getItem("father_register");
        var mother_image_name = localStorage.getItem("mother_register");



        var formData = new FormData(this);
        formData.append("father_image_name", father_image_name);
        formData.append("mother_image_name", mother_image_name);



        $.ajax({
            url: "/update-parent-data",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
                // $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response) 
            {
                console.log(response);

                if(response.status == "Update Success"){
                    Swal.fire({
                        title: "Parent Update Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      });
                    $(".search-parents").click();
                    $('.parent-update-form')[0].reset();
                    $(".modal-close").click();
                }

            
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});

// Delete Parents
$(document).ready(function(){
    $(".table-body").on("click", ".parent-delete", function () {


         Swal.fire({
            title: 'Are you sure delete parent ?',
            text: " Please note that deleting this parent will permanently remove all associated data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {

            var pr_id = $(this).attr("parent_id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:  "/delete-parent",
                method: 'POST',
                data:{
                    pr_id: pr_id,
                },
                 // Success 
                 success:function(response)
                 {

                    Swal.fire({
                        title: 'Delete Success',
                        text: "Parent data has been deleted",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Auto reload the page after the SweetAlert timer ends
                        location.reload();
                    });

                 },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });

          });
    
    });
});
 


