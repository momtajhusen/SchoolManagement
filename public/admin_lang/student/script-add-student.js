$(document).ready(function(){
    $(".hostel_outi").on("change", function(){
        if($(this).val() == "outi" || $(this).val() == " ")
        {
            $("#transport").removeClass("d-none");
            $("#transport_use").attr('required', true);
            $("#transport_root").attr('required', false);
            $("#hostel_deposite").addClass("d-none");
            $("#hostel_deposite").attr("required", true);


        }
        else{
            $("#transport").addClass("d-none");
            $("#transport_root").addClass("d-none");
            $("#transport_use").attr('required', false);
            $("#transport_root").attr('required', true);
            $("#hostel_deposite").removeClass("d-none");
            $("#hostel_deposite").attr('required', false);

            $("#transport_use option").filter(function () {
                return $(this).text() == "Choose Option";
            }).prop("selected", true);
            $("#transport_root option").filter(function () {
                return $(this).text() == "Select Root";
            }).prop("selected", true);
        }
    });
});

$(document).ready(function(){
    $("#transport_use").on("change", function(){
        if($(this).val() == "Yes" || $(this).val() == " ")
        {
          $("#transport_root").removeClass("d-none");
          $("#root_select").attr('required', true);
        }
        else{
          $("#transport_root").addClass("d-none");
          $("#root_select").attr('required', false);
          $('#root_select').prop('selectedIndex', 0);
        }
    });
});

// New Parent ? and Existing Parent ? 
$(document).ready(function() {
    // remove the form when the "Remove Form" button is clicked
    $('.existing-parent').click(function() {
        $(".parent-check").val("existing_parent");
        $('input[name="father_name"]').attr('required', false);
        $('input[name="father_phone"]').attr('required', false);
        $('input[name="mother_name"]').attr('required', false);
        $('input[name="father_email"]').attr('required', false);
        $(".search-parent").click();
    });
    // add the form again when the "Return Form" button is clicked
    $('.new-parent').click(function() {
      $(".parent-check").val("new_parent");
        $('input[name="father_name"]').attr('required', true);
        $('input[name="father_phone"]').attr('required', false);
        $('input[name="mother_name"]').attr('required', false);
        $('input[name="father_email"]').attr('required', false);
    });
});