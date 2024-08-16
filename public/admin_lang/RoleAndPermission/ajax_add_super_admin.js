$(document).ready(function() {
    $('.add-super-admin-form').on('submit', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: '/admin/add-super-admin',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.data){
                    Swal.fire({
                        title: "Super Admin Created Successfully!",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var error in errors) {
                        errorMessage += errors[error][0] + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('An error occurred: ' + xhr.responseText);
                }
            }
        });
    });
});