$(document).ready(function(){
    // Event delegation for dynamically added elements
    $(document).on('mouseenter', '.hover-image-preview', function(){
 
        // Get the image source
        var imgSrc = $(this).attr('src');
        
        // Check if imgSrc is a relative path
        if (!/^https?:\/\//i.test(imgSrc)) {
            var baseURL = window.location.protocol + '//' + window.location.host;
            imgSrc = baseURL + imgSrc;
        }
        
        console.log("Image source:", imgSrc);

        // Create a div for displaying image source
        var $infoBox = $(`<div class="image-info-box">
           <img src='${imgSrc}' style='width:150px;'>
        </div>`);

        // Find the closest modal
        var $modal = $(this).closest('.modal');
        
        // Append the div to the modal or body based on existence of modal
        if ($modal.length) {
            $modal.append($infoBox);
        } else {
            $('body').append($infoBox);
        }

        // Position the div next to the image
        var imgPosition = $(this).offset();
        var imgWidth = $(this).outerWidth();
        var imgHeight = $(this).outerHeight();
        
        $infoBox.css({
            'position': 'absolute',
            'top': imgPosition.top + imgHeight,
            'left': imgPosition.left + imgWidth,
            'background-color': '#fff',
            'border': '1px solid #ccc',
            'padding': '5px',
            'z-index': '1000',
        });
    }).on('mouseleave', '.hover-image-preview', function(){
        // Remove the div when mouse leaves the image
        $('.image-info-box').remove();
    });
});
