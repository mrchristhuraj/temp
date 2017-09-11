$(document).ready(function(){
    $("#about").click(function() {
	    $('#modal1').openModal();
    });

    $('body').keyup(function(event){
        if(event.keyCode == 13) {
            $("#button").click();
        }
    });
    
    $("#button").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        
        if(username.length === 0 ) {
            
            error_block = document.getElementById("error").innerHTML = "Username Cannot be Left Blank";
            return false;
        }
        
        if(password.length === 0 ) {
            
            error_block = document.getElementById("error").innerHTML = "Password Cannot be Left Blank";
            return false;
        }
        
        var data = 'uname='+username.toString()+'&pass='+password.toString();
        var responseID;
    
        $.ajax({
            type: 'POST',
            data: data,
            url: 'login_check.php',
            beforeSend: function() {
                document.getElementById("error").innerHTML = "Checking data... ";
                $(".progress").show();
                $("#button").hide();
            },
            success: function(responseID) {
                
                    console.log(responseID);
                $(".progress").hide();
                $("#button").show();
                //DEBUG:: 
                //$("body").append("<p>"+responseID+"</p>");
                if(responseID === 'S') {
                    window.location = 'login/student/home.php';
                } else if(responseID === 'F'){
                    window.location = 'login/faculty/home.php';
                } else if(responseID === 'C'){
                    window.location = 'login/coordinator/home.php';
                }else if(responseID == 'A'){
                    window.location = 'login/admin/home.php';
                }else if(responseID == 'O'){
                    window.location = 'login/reports/home.php';
                }else if (responseID == 0){
                    error_block = document.getElementById("error").innerHTML = "Wrong Credentials";
                }
            }
        });
    });
});
