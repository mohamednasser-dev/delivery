$(document).ready(function () {
    $('#kt_select2_4').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#new_from_num_cont').show();
                $('#cmb_new_from_num').html(data);
            }
        });
    });
    $('#kt_select2_5').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#new_to_num_cont').show();
                $('#cmb_new_to_num').html(data);
            }
        });
    });

    $('#kt_select2_1').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#tracomy_from_num_cont').show();
                $('#cmb_tracomy_from_num').html(data);
            }
        });
    });
    $('#kt_select2_2').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#tracomy_to_num_cont').show();
                $('#cmb_tracomy_to_num').html(data);
            }
        });
    });

    $('#kt_select2_3').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#revision_from_num_cont').show();
                $('#cmb_revision_from_num').html(data);
            }
        });
    });
    $('#kt_select2_66').change(function(){
        var sura_id = $(this).val();
        $.ajax({
            url: "/get_ayat_num/" + sura_id ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#revision_to_num_cont').show();
                $('#cmb_revision_to_num').html(data);
            }
        });
    });


});
