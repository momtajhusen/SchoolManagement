
$(document).ready(function() {
    $(".sidebar-nav-item").each(function(){

        var MenuCategoryName = $(this).find('a').eq(0).children('span').eq(1).html();
        var MenuCategoryIcon = $(this).find('a').eq(0).children('span').eq(0).html();

        var SubMenu = '';
        $(this).find('ul').children('li').each(function(){
            
            // alert($(this).find('a').html());

            var SubMenuText = $(this).find('span').html();
            var SubMenuUrl = $(this).find('a').attr('href');

            var parts = SubMenuUrl.split("/");
            var route = "/" + parts.slice(3).join("/");

            SubMenu += `<div class="input-group mb-3" style="background:#e9ecef;border:1px solid #ced4da">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input class="route-checked" type="checkbox" category="`+MenuCategoryName+`" route="`+route+`" aria-label="Checkbox for following text input" style="cursor:pointer;">
              </div>
            </div>
            <span class='p-1 px-2'>`+SubMenuText+`</span>
          </div>`;
        });

         $(".page-route-box").append(`
                <div class='col-xl-4 col-lg-6 col-12'>
                <div class="card">
                <div class="card-header d-flex aline-items-center">
                     <span class="material-symbols-outlined mr-2" style="font-size:20px;">`+MenuCategoryIcon+`</span>
                     <sapn>`+MenuCategoryName+`</span>
                </div>
                <div class="card-body routes-box-body d-flex flex-column">
                   `+SubMenu+`
                </div>
                </div> 
            </div>
         `);
    });
});



