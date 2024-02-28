$(document).ready(function(){

    var currentDomainWithProtocol = window.location.host;

    if(currentDomainWithProtocol == '127.0.0.1:8000'){
           $(".deve-use").removeClass("d-none");
    }
    else{
        $(".deve-use").addClass("d-none");
    }
});