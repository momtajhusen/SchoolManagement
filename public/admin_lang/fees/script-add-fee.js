$(document).ready(function(){
    $(".add-fee-btn").click(function(){
 
        if($('.select-class').val() != "")
        {
            var select_month = NepaliFunctions.GetCurrentBsDate().month - 1;
 
            // Add readonly attribute to the input fields for past months
            // for (var i = 0; i <= select_month; i++) 
            // {
            //     var month_input = "month_" + i + "[]";
            //     $("input[name='" + month_input + "']").attr("readonly", true);
            //     $("input[name='" + month_input + "']").css("background", "#f0f1f3");
            // }

            $(".not-fee-tr").remove();
            $(".fee-stracture-body").append(`
            <tr>
                <td>1</td>
                <td>
                    <span class="material-symbols-outlined trash-fee" style="cursor:pointer;">delete</span>
                    <span class="material-symbols-outlined" style="cursor:move;">drag_indicator</span>
                </td>
                <td><input type="text" required name="fee-type[]" class="px-2" style="width:150px;"></td>
                <td><input type="number" value="0" name="month_0[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_1[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_2[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_3[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_4[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_5[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_6[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_7[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_8[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_9[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_10[]" class="px-2" style="width:80px;"></td>
                <td><input type="number" value="0" name="month_11[]" class="px-2" style="width:80px;"></td>
            </tr>
        `);

        // Add readonly attribute to the input fields for past months
        // var select_month = NepaliFunctions.GetCurrentBsDate().month;
        // for (var i = 0; i < select_month; i++) { // modify the condition of the loop
        //     var month_input = "month_" + i + "[]";
        //     $("input[name='" + month_input + "']").attr("readonly", true);
        //     $("input[name='" + month_input + "']").css("background", "#f0f1f3");
        //     }
        }
        else{
          alert("plese select class");
        }

    });
});

    //   play url video in modal 
    $(document).ready(function(){
        $("body").on("click", ".trash-fee", function(){
             $(this).parent().parent().remove();
        });
       });