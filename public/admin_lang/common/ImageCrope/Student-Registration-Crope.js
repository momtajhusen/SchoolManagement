$(document).ready(function() {

    // Student Image Crope   
    $('#student_img_input').change(function(event) 
    {
        var $modal = $('#student-modal');
        var image = document.getElementById('student-sample_image');
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
            $('#student_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        }
    
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

          $(document).on("click", function(event) {
            if (event.target.id === 'student-modal') {
                $('#student_img_input').val("");
               $('#student_img_preview').attr("src",  "http://bit.ly/3IUenmf");
            }
          });
          
          $("#student-model-cancle").on("click", function() {
            $('#student_img_input').val("");
            $('#student_img_preview').attr("src",  "http://bit.ly/3IUenmf");
          });
          
    
        $("#student-crop").click(function() {
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
                    $('#student_img_preview').attr('src', base64data);
                    cropped = true; // set cropped to true after image is cropped
    
                    // Only send data to server if image has been cropped
                    if (cropped) {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        });
    
                        $.ajax({
                            url: "/student-img-crop",
                            method: "POST",
                            data: {
                                image: base64data
                            },
                            success: function(data) {
                                $modal.modal('hide');
                                var timestamp = new Date().getTime();
                                $('#student_img_preview').attr('src', 'http://127.0.0.1:8000/storage/' + data.path + '?' + timestamp);
                            }
                        });
                    }
    
                }
            });
        });
    });
 
    // Father Image Crope   
    $('#father_img_input').change(function(event) {
        var $modal = $('#fathert-modal');
        var image = document.getElementById('father-sample_image');
        var cropper;

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
            $('#father_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        }

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
 

        $(document).on("click", function(event) {
            if (event.target.id === 'fathert-modal') {
                $('#father_img_input').val("");
               $('#father_img_preview').attr("src",  "http://bit.ly/3IUenmf");
            }
          });
          
          $("#father-model-cancle").on("click", function() {
            $('#father_img_input').val("");
            $('#father_img_preview').attr("src",  "http://bit.ly/3IUenmf");
          });
    
        $("#father-crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
          
            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result; 

                   
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
    
                $.ajax({
                    url: "/father-img-crop",
                    method: "POST",
                    data: {
                        image: base64data
                    },
                    success: function(data){
                        $modal.modal('hide');
                        var timestamp = new Date().getTime();
                        $('#father_img_preview').attr('src', 'http://127.0.0.1:8000/storage/' + data.path + '?' + timestamp);
                    }
                });

                }
            });
        });
    });

    // Mother Image Crope   
    $('#mother_img_input').change(function(event) {
        var $modal = $('#mother-modal');
        var image = document.getElementById('mother-sample_image');
        var cropper;

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
            $('#mother_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        }

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $(document).on("click", function(event) {
            if (event.target.id === 'mother-modal') {
               $('#mother_img_input').val("");
               $('#mother_img_preview').attr("src",  "http://bit.ly/3IUenmf");
            }
          });
          
          $("#mother-model-cancle").on("click", function() {
            $('#mother_img_input').val("");
            $('#mother_img_preview').attr("src",  "http://bit.ly/3IUenmf");
          });
    
        $("#mother-crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
            
            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result; 

                    
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
    
                $.ajax({
                    url: "/mother-img-crop",
                    method: "POST",
                    data: {
                        image: base64data
                    },
                    success: function(data){
                        $modal.modal('hide');
                        var timestamp = new Date().getTime();
                        $('#mother_img_preview').attr('src', 'http://127.0.0.1:8000/storage/' + data.path + '?' + timestamp);
                    }
                });

                }
            });
        });
    });

});