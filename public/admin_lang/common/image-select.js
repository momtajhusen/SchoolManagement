 $(document).ready(function(){
    $(".imageinput").on("change", function() {
        var input = $(this)[0];
        var imagePreview = $(this).siblings(".imagepreview")[0];
        if (input.files && input.files[0]) 
        {
            // Check image size
            var imageSize = input.files[0].size / 1024; // in KB
            if (imageSize >= 80) // max size is 80 KB
            {
                alert("Image size should not exceed 80 KB.");
                $(this).val(""); // clear the input field
                $(imagePreview).attr("src", "http://bit.ly/3IUenmf"); // clear the preview
                return;
            }
            // Check image dimensions
            var img = new Image();
            img.onload = function() {
                var imgWidth = this.width;
                var imgHeight = this.height;
                if (imgWidth > 800 || imgHeight > 800)
                {
                    alert("Image dimensions should not exceed 800 x 800 pixels.");
                    $(this).val(""); // clear the input field
                    $(imagePreview).attr("src", "http://bit.ly/3IUenmf"); // clear the preview
                    return;
                }
                // Show preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(imagePreview).attr("src", e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            };
            img.src = URL.createObjectURL(input.files[0]);
        }
        else{
            $(imagePreview).attr("src",  "http://bit.ly/3IUenmf");
        }
    });
});

