$(document).ready(function(){
    $(document).keypress(function(event){
        if(event.which === 13){ // 13 is the keycode for Enter key
             $('.enter-click, .search-btn').click();
        }
    });
});