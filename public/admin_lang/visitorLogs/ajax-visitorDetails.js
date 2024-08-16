
// Vistior Name & Uniquie id Save in localstorage
$(document).ready(function(){

    var visitorId = localStorage.getItem('visitorid');
    var visitorBrowser = localStorage.getItem('visitorBrowser');
    var visitorOperatingSystem = localStorage.getItem('visitoroperatingSystem');
    var visitorAddress = localStorage.getItem('visitorAddress');


     // Generate Unique Id;
     var timestamp = new Date().getTime();
     var randomPart = Math.floor(Math.random() * 1000);
     var uniqueId = timestamp.toString() + randomPart.toString();
     uniqueId = uniqueId.slice(0, 10).padStart(10, '0');

    // Check if the key exists and has the expected value
    if (visitorId == null) {
        Swal.fire({
            title: "Enter your Name.",
            input: "text",
            inputAttributes: {
              autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Save",
            showLoaderOnConfirm: true,
            preConfirm: async (inputvalue) => {

                localStorage.setItem('visitorid', uniqueId);
                localStorage.setItem('visitorname', inputvalue);

                $('input[name="visitor_name"]').val(inputvalue);
                

                var visitorId = localStorage.getItem('visitorid');
                if (visitorId !== null && visitorId !== "") {
                    Swal.fire({
                        title: "Thanks !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                }

            },
          });
    } else {
        // alert("visitorId is not null");
    }





});

// Visitor Address Store in localstorage
$(document).ready(function(){

    if ("geolocation" in navigator) {
        // Get the user's current location
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
    
            // Use OpenCage Geocoding API to get the user's address
            var apiKey = '9bec724c67eb4a94b3cef51048fc6ff5';
            var apiUrl = 'https://api.opencagedata.com/geocode/v1/json?key=' + apiKey + '&q=' + latitude + '+' + longitude;
    
            // Make a GET request to the OpenCage API
            $.get(apiUrl, function(data) {
                if (data && data.results && data.results.length > 0) {
                    var addressComponents = data.results[0].components;
                     var userAddress = addressComponents.city + ', ' + addressComponents.state + ', ' + addressComponents.country;
    
                    localStorage.setItem('visitorAddress', userAddress);
                } else {
                    console.error('Unable to fetch address information.');
                }
            });
        }, function(error) {
            console.error("Error getting user location: " + error.message);
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
});

// Visitor Browser & Operating System in localstorage
$(document).ready(function(){
    var userAgent = navigator.userAgent;
    var browser = "";
    if (userAgent.indexOf("Chrome") != -1) {
        browser = "Chrome";
    } else if (userAgent.indexOf("Firefox") != -1) {
        browser = "Firefox";
    } else if (userAgent.indexOf("Safari") != -1) {
        browser = "Safari";
    } else if (userAgent.indexOf("Edg") != -1) {
        browser = "Microsoft Edge";
    } else if (userAgent.indexOf("MSIE") != -1 || userAgent.indexOf("Trident") != -1) {
        browser = "Microsoft Internet Explorer";
    } else {
        browser = "unknown browser";
    }
    
    // Operating system or device detection
    var operatingSystem = "";
    if (/Windows/i.test(userAgent)) {
        operatingSystem = "Windows";
    } else if (/Android/i.test(userAgent)) {
        operatingSystem = "Android";
    } else if (/iPhone/i.test(userAgent)) {
        operatingSystem = "iPhone";
    } else if (/Macintosh/i.test(userAgent)) {
        operatingSystem = "MacBook";
    } else {
        operatingSystem = "unknown operating system";
    }

    localStorage.setItem('visitorBrowser', browser);
    localStorage.setItem('visitoroperatingSystem', operatingSystem);

});

// Show Activity Btn 
$(document).ready(function(){
    var visitorname = localStorage.getItem('visitorname');
    if(visitorname == "Momtaj Husen" || visitorname == "Bijay sharma")
    {
        $("#activity-menu").removeClass("d-none");
    }
    else{
        $("#activity-menu").addClass("d-none"); 
    }
});

// demo visitor Form show if localStorage not demoVisitorForm == true
$(document).ready(function(){
    var url = window.location.href;
    var subdomain = (new URL(url)).hostname.split('.')[0];
    if(subdomain == "demo"){
        var demoVisitorSchool = localStorage.getItem('demoVisitorForm');
        if(demoVisitorSchool != "true"){
            $(".demo-visitor-main").removeClass("d-none");
        }
        else{
           $(".demo-visitor-main").addClass("d-none");
        }
    }
    else{
        $(".demo-visitor-main").addClass("d-none");
    }
});

// demo visitor form save 
$(document).ready(function(){

    $(".demo-visitor-form").submit(function (e) {
       e.preventDefault();
    

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


        var visitorId = localStorage.getItem('visitorid');
        var visitorname = $('input[name="visitor_name"]').val();
 

        var formData = new FormData($(this)[0]);
        // Append visitorId to formData
         formData.append('visitorId', visitorId);
         if( localStorage.getItem('visitorname') == null){
            localStorage.setItem('visitorname',  visitorname);
         }

        $.ajax({
            url: "/demo-visitor-data-save",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {

                console.log(response);

                alert(response);
                if(response.status == "save sucess"){
                    localStorage.setItem('demoVisitorForm',  "true");
                    $(".demo-visitor-main").addClass("d-none");
                    Swal.fire({
                        title: "Thanks !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
 
    });
});
