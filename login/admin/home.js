$(document).ready(function(){
    $('select').material_select();
    $(".courseBtn").click(function() {
        window.location = "addcourse.php";
    });

    $(".reportBtn").click(function() {
        window.location = "report.php";
    });

    $(".actionBtn").click(function() {
        window.location = "actions.php";
    });

    function getActiveCount() {
        $.ajax({
            type: 'POST',
            url: 'count.helper.elab.php',
            success: function(phpdata) {
                $("#activeSession").html(phpdata);
            }
        });
    };

    getActiveCount();
    setInterval(function() {
        getActiveCount();
    },5000);

    function refreshButtons() {
            $.ajax({
        type: 'POST',
        data: {
            'mode': 'get'
        },
        url: 'flag.helper.elab.php',
        dataType: 'json',
        success: function(phpdata) {
            if(phpdata['error'] == 1) {
                console.log(JSON.stringify(phpdata));
                window.alert("Error: Contact Admin");
            }
            if(phpdata['COPY_CONTROL'] == '1') {
                $('#copyControlBtn').html('CODE COPY: ENABLED');
            }
            else if(phpdata['COPY_CONTROL'] == '0') {
                $('#copyControlBtn').html('CODE COPY: DISABLED');
            }

            if(phpdata['FACULTY_REGISTER'] == '1') {
                $('#facultyRegisterControlBtn').html('FACULTY REGISTRATION: ENABLED');
            }
            else if(phpdata['FACULTY_REGISTER'] == '0') {
                $('#facultyRegisterControlBtn').html('FACULTY REGISTRATION: DISABLED');
            }

            if(phpdata['STUDENT_REGISTER'] == '1') {
                $('#stdentRegisterControlBtn').html('STUDENT REGISTRATION: ENABLED');
            }
            else if(phpdata['STUDENT_REGISTER'] == '0') {
                $('#stdentRegisterControlBtn').html('STUDENT REGISTRATION: DISABLED');
            }
            

        }
        });
    }

    refreshButtons();
    

    $('#getCourseNosBtn').click(function() {
        var course_id = $('#studentSelectionID :selected').val();
        if(course_id === "") {
            window.alert("First Select A Course...");
            return;
        }
        $.ajax({
        type: 'POST',
        data: "mode=countStudent&courseid=" + course_id,
        url: 'admin.helper.php',
        success: function(codedata) {
            $(".couseResultDiv").html(codedata);
        getFacultyies(course_id);
        }
      }); // <-- AJAX

    });

    function getFacultyies(course_id) {
        $.ajax({
        type: 'POST',
        data: "mode=facultyList&courseid=" + course_id,
        url: 'admin.helper.php',
        success: function(phpdata) {
            $('#facultySelectionID').html(phpdata);
            $('#facultySelectionID').material_select();
        }
        }); // <-- AJAX
    }

    $("#getFacultyNosBtn").click(function() {
        var course_id = $('#studentSelectionID :selected').val();
        var faculty_id = $('#facultySelectionID :selected').val();
        if(course_id === "") {
            window.alert("First Select A Course...");
            return;
        }
        if(faculty_id === "") {
            window.alert("First Select A Faculty...");
            return;
        }
         $.ajax({
        type: 'POST',
        data: "mode=facultyCount&courseid=" + course_id + '&facultyid=' + faculty_id,
        url: 'admin.helper.php',
        success: function(phpdata) {
            $('.facultyResultDiv').html(phpdata);
        }
        }); // <-- AJAX
    });

    function changeFlags(name,value) {
        $.ajax({
            type: 'POST',
            data: {
            'mode': 'set',
            'name': name,
            'val': value
            },
            url: 'flag.helper.elab.php',
            success: function(phpdata) {
                console.log(phpdata);
            if(phpdata == '1') {
                refreshButtons();
            }else {
                window.alert("ERROR CONTACT ADMIN");
            }
            }
        });
    }

    $('#copyControlBtn').click(function(){
        var value = 0;
        if($("#copyControlBtn").html() == 'CODE COPY: DISABLED') {
            value = 1;
        } else if($("#copyControlBtn").html() == 'CODE COPY: ENABLED'){
            value = 0;
        }
        changeFlags("COPY_CONTROL",value);
    });

     $('#facultyRegisterControlBtn').click(function(){
        var value = 0;
        if($("#facultyRegisterControlBtn").html() == 'FACULTY REGISTRATION: DISABLED') {
            value = 1;
        } else if($("#facultyRegisterControlBtn").html() == 'FACULTY REGISTRATION: ENABLED'){
            value = 0;
        }
        changeFlags("FACULTY_REGISTER",value);
    });

     $('#stdentRegisterControlBtn').click(function(){
        var value = 0;
        if($("#stdentRegisterControlBtn").html() == 'STUDENT REGISTRATION: DISABLED') {
            value = 1;
        } else if($("#stdentRegisterControlBtn").html() == 'STUDENT REGISTRATION: ENABLED'){
            value = 0;
        }
        changeFlags("STUDENT_REGISTER",value);
    });
});
