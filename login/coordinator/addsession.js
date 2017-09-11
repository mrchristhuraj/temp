$(document).ready(function() {
    displayData();
    var text = new Array(10);
    $('#addSessionBtn').click(function(){
        for(var i=11;i<21;i++) {
            var name = '#session' + (i-10);
            text[i] = $(name).val();

            if(text[i] === "") {
                window.alert('ENTER SESSION NAME FOR: ' + (i-10));
                throw new Error('');
            }
        }
            

        $.ajax({
            type: 'POST',
            data: {
                session_names: text,
                action: "POST",
            },
            url: 'addsession.helper.php',
            dataType: 'json',            
            success: function(phpdata) {
                var response = parseInt(phpdata['error']);
                if(response == 0) {
                    window.alert("SESSION NAMES ADDED");
                }else if(response == 1) {
                    window.alert("SESSION NAMES ADDITION FAILED" +  phpdata['error_msg']);
                }else{
                    window.alert("ERROR:: CONTACT ADMIN" + phpdata['error_msg']);                        
                }
                displayData();
            }
        });
    });


    function displayData() {
        $.ajax({
            type: 'POST',
            data: {
                action: "GET",
            },
            url: 'addsession.helper.php',
            dataType: 'json',
            success: function(phpdata) {
                var response = parseInt(phpdata['error']);
                    if(response == 0) {
                        for(var i=11;i<21;i++) {
                            var name = '#session' + (i-10);
                            $(name).val(phpdata[i]);
                        }
                    }else{
                        window.alert("ERROR:: CONTACT ADMIN" + phpdata['error_msg']);                        
                    }

        Materialize.updateTextFields();
            }
        });

    } 



});