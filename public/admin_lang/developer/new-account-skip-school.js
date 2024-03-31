$(document).ready(function(){
    var website = ['dev', 'gurukul', 'sunrise'];
    var subdomain = window.location.hostname.split('.')[0]; // Extract subdomain from URL

    if (website.includes(subdomain)) {
        alert('Subdomain matches one of the websites in the array: ' + subdomain);
    } else {
        alert('Subdomain does not match any of the websites in the array: ' + subdomain);
    }
});
