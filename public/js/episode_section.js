$(document).ready(function () {

    $(document).on('click', 'input[id="rb_student_id"]', function () {
        var student_id = $(this).data('student');
        var email = $(this).data('email');
        var name = $(this).data('name');
        var qustionid = $(this).data('qustionid');
        var subject_level_id = $(this).data('sub-level-id');
        var image = $(this).data('image');
        $("#txt_student_id").val(student_id);
        $("#txt_student_name").val(name);
        $("#txt_student_email").val(email);
        $("#txt_student_image").val(email);
        $("#txt_qustion_id").val(qustionid);
        $("#btn_save_eva").show();
        // $('#student_image').attr('style', "background-image:url('/uploads/students/".image."')");
        // $.ajax({
        //     route: "t_episodes.get_student_info",
        //     type:'get',
        //     data: { student_id : student_id },
        //     success: function (data) {
        //         $('#image_cont').parent().parent().html(data);
        //         // el.parent().parent().html(data);
        //         // $('#home_club_modal').modal('hide');
        //     }
        // })
    });
});
