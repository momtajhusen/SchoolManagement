$(document).ready(function(){
   $(".search-select").click(function(){

    $('.search-select').each(function(){
        $(this).css('border','1px solid #888');
        $(this).css('color','#888');
    });
 
    $(this).css('border','1px solid #ff9d37');
    // $(this).css('background-color','#042954');
    $(this).css('color','black');
 
   });
});


// $(document).ready(function(){
//     $("#student_box").on("click", ".students", function()
//     {
//          $('.students').each(function(){
//           $(this).css('border', '0px');
//           $(this).removeClass('selected-sudent');
//          });

//          $(this).css('border', '2px solid #042954');
//          $(this).addClass('selected-sudent');

//          var st_id = $(this).attr('st_id');
//          $(".add-month").attr('st_id', st_id);
//          $(".save-deal-fee").attr('st_id', st_id);

//     });
// });