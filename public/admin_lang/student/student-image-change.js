$(document).ready(function() {

    // Student Image Crope   
    $('#student_img_input').change(function(event) 
    {
 ;

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
                preview: '#student_preview'
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


                        // Check if a key exists in localStorage
                        if (localStorage.getItem("student_register") === null) {
                            var image_name = "student-"+new Date().toISOString().replace(/[-:.TZ]/g, '') + Math.floor(Math.random() * 10000);
                            localStorage.setItem("student_register", image_name);
                        } else {
                            var image_name = localStorage.getItem("student_register");
                        }
                        

                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        });

    
                        $.ajax({
                            url: "/student-img-crop",
                            method: "POST",
                            data: {
                                image: base64data,
                                image_name: image_name,
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
                                $('#student_img_preview').attr('src', currentDomainWithProtocol+'/storage/' + data.path + '?' + timestamp);
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

    // Document Image Crope   
    $('#document_img_input').change(function(event) {
        var $modal = $('#document-modal');
        var image = document.getElementById('document-sample_image');
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
            $('#document_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        }
    
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: NaN,
                dragMode: 'move',
                viewMode: 2,
                cropBoxResizable: true,
                cropBoxMovable: true,
                minCropBoxWidth: 10,
                minCropBoxHeight: 10,
                maxCropBoxWidth: 400,
                maxCropBoxHeight: 400,
                maxCanvasWidth: 800,
                maxCanvasHeight: 800,
                preview: '#document_preview',
                ready: function () {
                    cropper.setCropBoxData({ width: 80, height: 80 });
                },
                crop: function (event) {
                    console.log(event.detail.width, event.detail.height);
                }
            });
            
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        
    
        $(document).on("click", function(event) {
            if (event.target.id === 'document-modal') {
                $('#document_img_input').val("");
                $('#document_img_preview').attr("src",  "http://bit.ly/3IUenmf");
            }
        });
    
        $("#document-model-cancle").on("click", function() {
            $('#document_img_input').val("");
            $('#document_img_preview').attr("src",  "http://bit.ly/3IUenmf");
        });
    
        $("#document-crop").click(function() {
            var cropWidth = parseInt($('#crop_width').val());
            var cropHeight = parseInt($('#crop_height').val());

            $(".crop-loading").removeClass("d-none");
            $(".crop-icon").addClass("d-none");
            $(".crop-text").html("Wait..");
    
            canvas = cropper.getCroppedCanvas({
                width: cropWidth,
                height: cropHeight,
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

                    // Check if a key exists in localStorage
                    if (localStorage.getItem("document_register") === null) {
                        var image_name = "document-"+new Date().toISOString().replace(/[-:.TZ]/g, '') + Math.floor(Math.random() * 10000);
                        localStorage.setItem("document_register", image_name);
                    } else {
                        var image_name = localStorage.getItem("document_register");
                    }
    
                    $.ajax({
                        url: "/document-img-crop",
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
                            $('#document_img_preview').attr('src', currentDomainWithProtocol+'/storage/' + data.path + '?' + timestamp);
                        },
                        error: function (xhr, status, error) 
                        {
                            console.log(xhr.responseText);
                        },
                    });
    
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
                preview: '#father_preview'
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

                // Check if a key exists in localStorage
                if (localStorage.getItem("father_register") === null) {
                    var image_name = "father-" + new Date().toISOString().replace(/[-:.TZ]/g, '') + Math.floor(Math.random() * 10000);
                    localStorage.setItem("father_register", image_name);
                } else {
                    var image_name = localStorage.getItem("father_register");
                }
    
                $.ajax({
                    url: "/father-img-crop",
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
                        $('#father_img_preview').attr('src', currentDomainWithProtocol+'/storage/' + data.path + '?' + timestamp);
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
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
                preview: '#mother_preview'
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

                // Check if a key exists in localStorage
                if (localStorage.getItem("mother_register") === null) {
                    var image_name = "mother-" + new Date().toISOString().replace(/[-:.TZ]/g, '') + Math.floor(Math.random() * 10000);
                    localStorage.setItem("mother_register", image_name);
                } else {
                    var image_name = localStorage.getItem("mother_register");
                }
                
    
                $.ajax({
                    url: "/mother-img-crop",
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
                        $('#mother_img_preview').attr('src',  currentDomainWithProtocol+'/storage/' + data.path + '?' + timestamp);
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });

                }
            });
        });
    });


    
    

});