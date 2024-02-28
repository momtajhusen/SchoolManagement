    // Teacher Image Crope   
    $('#teacher_img_input').change(function(event) 
    {
        var $modal = $('#teacher-modal');
        var image = document.getElementById('teacher_sample_image');
        var cropper;
        var cropped = false; // added variable to keep track of whether image has been cropped
    
        var files = event.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
    
        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
        else {
            $('#teacher_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        }
    
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '#teacher_preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

          $(document).on("click", function(event) {
            if (event.target.id === 'teacher-modal') {
                $('#teacher_img_input').val("");
               $('#teacher_img_preview').attr("src",  "http://bit.ly/3IUenmf");
            }
          });
          
          $("#teacher-model-cancle").on("click", function() {
            $('#teacher_img_input').val("");
            $('#teacher_img_preview').attr("src",  "http://bit.ly/3IUenmf");
          });
          
    
        $("#teacher-crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
    
            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
    
                    $modal.modal('hide');
                    $('#teacher_img_preview').attr('src', base64data);
                    cropped = true; // set cropped to true after image is cropped
    
                    // Only send data to server if image has been cropped
                    if (cropped) {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        });

                        // Check if a key exists in localStorage
                        if (localStorage.getItem("teacher_register") === null) {
                            var image_name = "teacher-" + new Date().toISOString().replace(/[-:.TZ]/g, '') + Math.floor(Math.random() * 10000);
                            localStorage.setItem("teacher_register", image_name);
                        } else {
                            var image_name = localStorage.getItem("teacher_register");
                        }
    
                        $.ajax({
                            url: "/teacher-img-crop",
                            method: "POST",
                            data: {
                                image: base64data,
                                image_name:image_name,
                            },
                            beforeSend: function () {
                                $(".crop-loading").removeClass("d-none");
                                $(".crop-icon").addClass("d-none");
                                $(".crop-text").html("Wait..");
                            },
                            success: function(data){
                                $(".crop-loading").addClass("d-none");
                                $(".crop-icon").removeClass("d-none");
                                $(".crop-text").html("CROP");
                                
                                var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                                $modal.modal('hide');
                                var timestamp = new Date().getTime();
                                $('#teacher_img_preview').attr('src', currentDomainWithProtocol+'/storage/' + data.path + '?' + timestamp);
                            },
                            error: function (xhr, status, error) 
                            {
                                console.log(xhr.responseText);
                            },
                        });
                    }
    
                }
            });
        });
    });