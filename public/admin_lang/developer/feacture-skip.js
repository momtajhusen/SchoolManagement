$(document).ready(function(){
    var website = ['gurukul', 'developer'];
    var subdomain = window.location.hostname.split('.')[0];
 
    if(subdomain != '127' && subdomain != 'dev'){
        if (website.includes(subdomain)) {
            $('#new-account-menu').remove();
            $('#new-report-menu').remove();
        }else{
            $('#old-account-menu').remove();
            $('#old-report-menu').remove();
        }
    }
});
