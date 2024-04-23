// $(document).ready(function(){
//    $(".set-student-fee").click(function(){
         
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                     "content"
//                 ),
//             },
//         });

//         $.ajax({
//             url: "/student-fee-set",
//             method: "POST",
//             // Success
//             success: function (response) {
//                console.log(response);
//             },
//             error: function (xhr, status, error) 
//             {
//                 console.log(xhr.responseText);
//             },
//         });


//    });
// });


$(document).ready(function(){
    $(".set-new-account-student-fee").click(function(){
          
         $.ajaxSetup({
             headers: {
                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                     "content"
                 ),
             },
         });
 
         $.ajax({
             url: "/set-new-account-student-fee",
             method: "POST",
             // Success
             success: function (response) {
                console.log(response);

                alert(response);
             },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
         });
 
 
    });
 });