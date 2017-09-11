$(document).ready(function() {
    $('select').material_select();


    $("#addFacultyBtn").click(function(){
        var faculty_id = $('#facultySelectioID :selected').val();
        var faculty_data = $('#facultySelectioID :selected').text();
        var password = $("#passwordInput").val();
        if(!faculty_id) {
            window.alert("Select A Faculy!!");
            return;
        }

        if(!password) {
            window.alert("Enter a Valid Password...");
            return;
        }

        var c = confirm("Change the student password? ");
        if(!c) return;

        $.ajax({
            type: 'POST',
            data: 'id=' + faculty_id + '&rowData=' + faculty_data + '&password=' + password,
            url: 'student.password.change.php',
            success: function(response) {
                window.alert(response);
            }
        });

    });





});