$(document).ready(function(){
    $('select').material_select();
    $(".dropdown-button").dropdown();
    


    //$(".button-collapse").sideNav();

    $("#viewDetailsBtn").click(function(){
        var faculty_id = $('#facultySelectioID :selected').val();
        var faculty_data = $('#facultySelectioID :selected').text();
        if(faculty_id != "") {
            $.ajax({
                type: 'POST',
                data: 'id=' + faculty_id,
                url: 'coordinator.home.helper.php',
                dataType: 'json',
                success: function(response) {
                    if(parseInt(response['error']) === 0) {
                        $('#l1').html(response['L1']);
                        $('#l2').html(response['L2']);
                        $('#l3').html(response['L3']);
                    }else {
                        console.log("ERROR CONTACT ADMIN");
                        console.log(response);
                    }
                }
            });
        }else {
            window.alert("FIRST SELECT A FACULTY");
        }
    });

    $("#solveQuestionBtn").click(function(){
        var question_no = $("#question_no_text_field").val();
        var course_name = $("#course_name_text").text().toLowerCase();
        if(question_no == "") {
            window.alert("INVALID QUESTION NUMBER");
        }else {
            //Redirect to New Page
            window.location = "./test/"+course_name+"/"+course_name+".code.php?q="+question_no;
        }
    });


    $('.toggle_switch').change(function(){
        if($('.toggle_switch :checked').val()) {
            window.alert('ON');
        }else {
            window.alert('off');
        }
    });

    $('#maxLevelUpdateBtn').click(function () {
        var max_level = $('#levelSelect').val();

        $.ajax({
            type: 'POST',
            data: {
                'level': max_level
            },
            url: 'level.update.helper.php',
            dataType: 'json',
            success: function(response) {
                if(parseInt(response['error']) === 0) {
                    window.alert("Max Level Sucessfully Updated...")
                }else {
                    console.log("ERROR CONTACT ADMIN");
                    console.log(response);
                }
            }
        });
    });

    


});
