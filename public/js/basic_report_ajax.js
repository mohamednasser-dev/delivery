$(document).ready(function () {
    $('#kt_select2_1').change(function(){
        var level = $(this).val();
        $.ajax({
            url: "/get_students/" + level ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#student_cont').show();
                $('#kt_select2_2').html(data);
            }
        });
    });
    $('#cmb_country').change(function(){
        var level = $(this).val();
        $.ajax({
            url: "/get_zones/" + level ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#zones_cont').show();
                $('#lbl_zones_cont').show();
                $('#cmb_zones').html(data);
            }
        });
    });
    $('#cmb_zones').change(function(){
        var subject = $(this).val();
        $.ajax({
            url: "/get_cities/" + subject ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#city_cont').show(data);
                $('#lbl_cities_cont').show(data);
                $('#cmb_cities').html(data);
            }
        });
    });

    $('#cmb_cities').change(function(){
        var level = $(this).val();
        $.ajax({
            url: "/get_districts/" + level ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#districts_cont').show();
                $('#lbl_districts_cont').show();
                $('#cmb_districts').html(data);
            }
        });
    });
    $('#cmb_college').change(function(){
        var subject = $(this).val();
        $.ajax({
            url: "/get_episodes/" + subject ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#episodes_cont').show(data);
                $('#lbl_episodes_cont').show(data);
                $('#cmb_episodes').html(data);
            }
        });
    });
    $('#cmb_dorr').change(function(){
        var subject = $(this).val();
        $.ajax({
            url: "/get_episodes/" + subject ,
            dataType: 'html',
            type: 'get',
            success: function (data) {
                $('#episodes_cont').show(data);
                $('#lbl_episodes_cont').show(data);
                $('#cmb_episodes').html(data);
            }
        });
    });


});
