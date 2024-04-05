// Get All Class in Table
// $(document).ready(function(){
 
//     $.ajax({
//         url: "/get-all-class",
//         method: 'GET',
//          // Success 
//         success:function(response)
//         {

//             console.log(response);

//             $(".class-select").html(``);
//             $(".class-select").append(`<option value="">Select Class</option>`);
//             var count = 0;
//             response.class.forEach(function(data){
//             var index = count++;

//                 var class_id = response.class[index].id;
//                 var classes = response.class[index].class;
//                 var section = response.class[index].section;
//                 var class_teacher = response.class[index].class_teacher;
//                 var start_date = response.class[index].start_date;
//                 var end_date = response.class[index].end_date;
//                 var capacity = response.class[index].capacity;
//                 var location = response.class[index].location;
 

//                 $(".class-select").append(`
//                   <option class="class-option" value="`+response.class[index].class+`" clsid="`+response.class[index].id+`">`+response.class[index].class+`</option>
//                 `);

//                 $(".class-table").append(`
//                 <tr>
//                     <td>`+class_id+`</td>
//                     <td>`+classes+`</td>
//                     <td>`+section+`</td>
//                     <td>`+class_teacher+`</td>
//                     <td>`+start_date+`</td>
//                     <td>`+end_date+`</td>
//                     <td>`+capacity+`</td>
//                     <td>`+location+`</td>
//                     <td>
//                         <div class="dropdown">
//                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"
//                                 aria-expanded="false">
//                                 <span class="flaticon-more-button-of-three-dots"></span>
//                             </a>
//                             <div class="dropdown-menu dropdown-menu-right">
//                                 <a class="dropdown-item edit-class d-none" class_id="`+class_id+`" classes="`+classes+`" section="`+section+`" class_teacher="`+class_teacher+`" start_date="`+start_date+`" end_date="`+end_date+`" capacity="`+capacity+`" location="`+location+`" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
//                                 <a class="dropdown-item delete-class" class_id="`+class_id+`" href="#"><i class="fas fa-trash text-danger"></i> Delete</a>
//                             </div>
//                         </div>
//                     </td>
//                 </tr>
//                 `);
//             });

//         },
//         error: function (xhr, status, error) 
//         {
//             console.log(xhr.responseText);
//         },
//     });

// });

// All Class in option retrive in in select after page open
$(document).ready(function(){
    $.ajax({
        url: "/option-all-class",
        method: 'GET',
         // Success 
        success:function(response)
        {
            console.log(response);
            $(".class-select").html(``);
            $(".class-select").append(`<option value="">Select Class</option>`);
            $(".class-select").append(`<option value="all_class">All Class</option>`);
            var count = 0;
            response.optionClass.forEach(function(optionClass){
            var index = count++;

                $(".class-select").append(`
                  <option class="class-option" value="`+response.optionClass[index].class+`" clsid="`+response.optionClass[index].id+`">`+response.optionClass[index].class+`</option>
                `);
            });
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});

// Get Section Class change
$(document).ready(function(){
    $(".class-select").change(function () {
        var classvalue = $(this).val();

        $(".section-select").html('');
        $(".section-select").append(`<option value="all_section">All Section</option>`);

        $.ajax({
            url: "/admin/class-section",
            method: "GET",
            data: {
                class: classvalue,
                current_year: current_year,
            },
        // Success
        success: function (response) {

       // Access the class data from the response
       var classes = response.data;

       // Loop through the classes and do something with each class object
       $(".section-select").append(`<option value="all_section">All Section</option>`);
       $(".student_roll").val(``);
       for (var i = 0; i < classes.length; i++) {
           var classObj = classes[i];
           console.log(classObj.class);
           console.log(classObj.section);
           console.log(classObj.capacity);
           // ... and so on

           $(".section-select").append(`<option value="`+classObj.section+`">`+classObj.section+`</option>`);
       }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
        });

    }); 
});