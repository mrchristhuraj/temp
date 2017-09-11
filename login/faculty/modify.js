$(document).ready(function(){
    $('#changePasswordButton').click(function() {
        var studentID = $("#username").val();
        var password = $('#password').val();
        var passwordRetype = $('#passwordRetype').val();
        console.log(studentID);
        console.log(password);
        console.log(passwordRetype);
        var confirm = window.confirm("Change Password?");
        //confirm = true;
        if(confirm) {
            $.ajax({
            type: 'POST',
            data: {
                'studentID': studentID,
                'password': password,
                'password2': passwordRetype    
            },
            url: 'modify.helper.php',
            success: function(responseID) {
                console.log(responseID);
                Materialize.toast(responseID, 4000);                          
            }
            });
        }else {
            Materialize.toast('Request Cancelled By User!', 4000);            
        }
    });
});