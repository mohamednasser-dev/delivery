$(document).ready(function () {
    $('#cmb_levels').change(function(){
        var level = $(this).val();
        $.ajax({
            url: "/get_subjects/" + level ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#subject_cont').show();
                $('#lbl_subject_cont').show();
                $('#cmb_subjects').html(data);
            }
        });
    });



    $('#Academic_year').change(function(){
        var subject = $(this).val();
        $.ajax({
            url: "/get_Academic_semesters/" + subject ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#Academic_semester').html(data);
                $('#academy_semester').show();
            }
        });
    });
    $('#cmb_subjects').change(function(){
        var subject = $(this).val();
        $.ajax({
            url: "/get_subject_levels/" + subject ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#subject_level_cont').show(data);
                $('#lbl_subject_level_cont').show(data);
                $('#cmb_subject_levels').html(data);
            }
        });
    });
    $('input[id="not_free_rb"]').click(function(){
        if($(this).prop("checked") == true){
            $('#cont_not_free').show();
        }else if($(this).prop("checked") == false){
            $('#cont_not_free').hide();
        }
    });

    $('input[id="free_rb"]').click(function(){
        if($(this).prop("checked") == true){
            $('#cont_not_free').hide();
        }else if($(this).prop("checked") == false){
            $('#cont_not_free').show();
        }
    });

});
