$(document).ready(function () {
    $(".class-subject-table").on("click", ".edit-subject", function () {
        $(".update-btn").removeClass("d-none");
        $(".upload-btn").addClass("d-none");

        var subject_id = $(this).attr("subject_id");
        var subject_name = $(this).parent().parent().parent().parent().find(".subject-name").html();
        var class_name = $(this).parent().parent().parent().parent().find(".class-name").html();
        var subject_teacher = $(this).parent().parent().parent().parent().find(".subject-teacher").html();
        var subject_code = $(this).parent().parent().parent().parent().find(".subject-code").html();

        $("#class-select").val(class_name);
        $(".subject_name").val(subject_name);
        $("#subject_teacher").val(subject_teacher);
        $("#subject_code").val(subject_code);

        $(".update-btn").attr('subject_id', subject_id);

    });
});
