// Save On Page Wating Time 
$(document).ready(function () {

    var pageLogCurrentSecond = localStorage.getItem('pageLogCurrentSecond');
    var pageLogCurrentPage = localStorage.getItem('pageLogCurrentPage');
    if(pageLogCurrentSecond){
        localStorage.setItem('pageLogPrevSecond',  pageLogCurrentSecond);
        localStorage.setItem('pageLogPrevPage',  pageLogCurrentPage);
    }

    // Get the current page URL
    var currentUrl = window.location.href;
    var segments = currentUrl.split('/');
    var page = segments[segments.length - 1];

    // wating second 
    var second = 0;
    setInterval(function () {
        localStorage.setItem('pageLogCurrentSecond',  second++);
    }, 1000);
    localStorage.setItem('pageLogCurrentPage',  page);

    // current date 
    var { year, month, day } = NepaliFunctions.GetCurrentBsDate();
    var current_date = `${year}-${month}-${day}`;

    var visitorId = localStorage.getItem('visitorid');
    var visitorname = localStorage.getItem('visitorname');
    var visitorAddress = localStorage.getItem('visitorAddress');

    if (visitorId !== null) {
        var pageLogPrevPage = localStorage.getItem('pageLogPrevPage'); 
        var pageLogPrevSecond = localStorage.getItem('pageLogPrevSecond');
        var device = localStorage.getItem('visitoroperatingSystem');
        var browser = localStorage.getItem('visitorBrowser');

        if(pageLogPrevPage){

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "/admin/visitor-page-log",
                method: "POST",
                data:{
                  current_date:current_date,
                  visitorid:visitorId,
                  visitorname:visitorname,
                  page:pageLogPrevPage,
                  device:device,
                  browser:browser,
                  watingtime:pageLogPrevSecond,
                  visitorAddress:visitorAddress,
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });

        }
    }

});




