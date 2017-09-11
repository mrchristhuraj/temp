$(document).ready(function(){
    $("#courseTable").html("");
    displayTable();
    $('#addBtnDiv').hide();
    $('#loadingDiv').hide();

    var loading = '<div class="center"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div="circle"></div></div></div></div></div>';

    



    function displayTable() {
        $.ajax({
            type: 'POST',
            url: 'addcourse.helper.php',
            success: function(phpdata) { 
                $("#courseTable").html(phpdata);
            }
        });
    }

    $(".addCourseBtn").click(function(){
       $('#addBtnDiv').show();
       $('#errorDiv').hide();
    });

    $('#addBtn').click(function(){
       var name = $('#course_name').val().toUpperCase();
       if(name != "") {
           $.ajax({
            type: 'POST',
            data: 'course_name=' + name + '&action=ADD',
            beforeSend: function() {
                var name = $('#course_name').val("");
                $('#addBtnDiv').hide();
                $('#loadingDiv').show();
            },
            url: 'course.php',
            dataType: "json",
            success: function(phpdata) { 
                $('#errorDiv').show();
                $('#loadingDiv').hide();
                if(parseInt(phpdata['error']) == 0) {
                    $('#errorDiv').html('<div class="green-text text-darken-2"> COURSE SUSSESFULLY ADDED </div><br><p class="flowtext">Username: ' + phpdata['username'] +' </p><p class="flowtext">Password: ' + phpdata['password'] +'</p><br><p class="flowtext">Qusetion Table Name: ' + name +'_QUESTION_TABLE</p>');
                }else {
                    $('#errorDiv').html('<div class="red-text text-darken-2"> ADDITION OF COURSE FAILED</div>');                 
                }
                displayTable();
            }
        });
       }

    });


});