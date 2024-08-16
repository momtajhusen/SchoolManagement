// Check Menu & Sub Menu Avable for Hide and Show 
$(document).ready(function(){

    $.ajaxSetup({
       headers: {
           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
       },
   });

   var role_type = localStorage.getItem('admin-role-type');

    if(role_type == 'sub_admin')
    {
       $(".sidebar-menu-content").addClass('d-none');
    }

   $.ajax({
       url: "/admin/user-routes-check",
       method: "GET",
       // Success
       success: function (response) 
       {

           console.log(response);
              $(".sidebar-menu-content").removeClass('d-none');
               //  Menu Category Show or Hide 
               const menuCategories = response.MenuCategory;
               if(menuCategories){
                   const categoryValues = Object.values(menuCategories);
                   $(".sidebar-nav-item").each(function(){
                       var menuItem = $(this);
                       var menuItemName = menuItem.find('a').eq(0).children('span').eq(1).html();
                       var matched = false;
                   
                       categoryValues.forEach(category => {
                           if (category === menuItemName) {
                               matched = true;
                           }
                       });
                   
                       if (matched) {
                           menuItem.removeClass('d-none');
                       } else {
                           menuItem.addClass('d-none');
                       }
                   });
               }
               else{
                $(".sidebar-nav-item").each(function(){
                    $(this).removeClass("d-none");
                });
               }

               //  Menu Category Show or Hide 
               const RouteData = response.RoutesData;
               if(RouteData){
                   const routeValue = Object.values(RouteData);

                   $(".nav-item").find('ul').children('li').each(function(){
                       var SubMenuItem = $(this);

                       var SubMenuUrl = $(this).find('a').attr('href');
                       var parts = SubMenuUrl.split("/");
                       var hrefroute = "/" + parts.slice(3).join("/");
                       var matched = false;

                   
                       routeValue.forEach(route => {
                           if (route === hrefroute) {
                               matched = true;
                           }
                       });
                   
                       if (matched) {
                           SubMenuItem.removeClass('d-none');
                       } else {
                           SubMenuItem.addClass('d-none');
                       }
                   });

               }else{
                $(".nav-item").find('ul').children('li').each(function(){
                    $(this).removeClass("d-none");
                });
               }


       },
       error: function (xhr, status, error) 
       {
           console.log(xhr.responseText);
       }
   });

}); 