$(document).ready(function(){

    $(document).on('click', '[visitorbtn="btn"]', function() {

    var btn_name = $(this).attr("btnName");

    // Get the current page URL
    var currentUrl = window.location.href;
    var segments = currentUrl.split('/');
    var page = segments[segments.length - 1];

    // current date 
    var { year, month, day } = NepaliFunctions.GetCurrentBsDate();
    var current_date = `${year}-${month}-${day}`;
 
    if (visitorId !== null) {

        var visitorId = localStorage.getItem('visitorid');
        var visitorname = localStorage.getItem('visitorname');
        var device = localStorage.getItem('visitoroperatingSystem');
        var browser = localStorage.getItem('visitorBrowser');
        var visitorAddress = localStorage.getItem('visitorAddress');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/visitor-button-clicking",
            method: "POST",
            data:{
              current_date:current_date,
              visitorid:visitorId,
              visitorname:visitorname,
              page:page,
              btn_name:btn_name,
              device:device,
              browser:browser,
              visitorAddress:visitorAddress,
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    }

    });
});

