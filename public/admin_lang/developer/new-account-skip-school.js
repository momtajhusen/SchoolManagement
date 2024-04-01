$(document).ready(function(){
    var website = ['gurukul', 'sunrise'];
    var subdomain = window.location.hostname.split('.')[0];

    if (website.includes(subdomain)) {
        $('#new-account-menu').remove();
    }else{
        $('#old-account-menu').remove(); 
    }
});
