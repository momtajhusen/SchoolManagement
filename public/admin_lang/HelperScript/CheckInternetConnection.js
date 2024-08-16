$(document).ready(function(){
        if (!navigator.onLine) {
            $('body').append(`
            <div class="custom-wrapper">
                <div class="custom-toast">
                    <div class="custom-content">
                        <div class="custom-icon bg-danger">
                          <span class="material-symbols-outlined">wifi_off</span>
                        </div>
                        <div class="custom-details">
                            <span>You're offline !</span>
                            <p>Please check your Internet connection.</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined custom-close-icon internete-refresh-icon">refresh</span>
                </div>
            </div>
        `);
        } else {
            console.log("Internet is connected.");
        }
    

    // Delegate click event for refresh icon to the body
    $('body').on('click', '.internete-refresh-icon', function() {
        location.reload();
    });
});
