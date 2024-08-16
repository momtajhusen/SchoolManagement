 // Re Enter 
 $(document).ready(function(){
    $("#re-enter-btn").click(function(){
      var st_id = $(this).attr("st_id");
       if(st_id != "#")
       {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            $.ajax({
                url: "/kickout-student-re-enter",
                method: "post",
                data:{
                    st_id:st_id,
                },
                // Success
                success: function (response) {
        
                   if(response.message == "save success"){
                        alert("Success Re-enter");
                   }
        
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
       }
       else{
        alert("select student & search");
       }
    });
 });