// Function to get user agent information
function getUserAgentInfo() {
    return navigator.userAgent;
}

// Send device information to the Laravel route using AJAX
$(document).ready(function() {
    var deviceInfo = getUserAgentInfo();

    $.ajax({
        type: 'POST',
        url: '/getDeviceInfo',
        data: { deviceInfo: deviceInfo },
        dataType: 'json',
        success: function(response) {
            $('#userAgentInfo').text(deviceInfo);
            console.log(response.message);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});