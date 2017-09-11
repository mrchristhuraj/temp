$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
    
    $('select').material_select();
    $("#view-result-btn").click(function(){
        var stud_id = $('#listregid :selected').val();
        var course_name = $('#listcourseid :selected').text();
        if(stud_id == "" || course_name == "") {
            window.alert("Select student and course name...");
        }
        data = 'studid=' + stud_id + '&coursename=' + course_name;
        if(stud_id !== '' && course_name !== 'Choose Course') {
            $.ajax({
            type: 'POST',
            data: data,
            url: 'home.list.php',
            dataType: 'json',
            success: function(phpdata) {
                //$("#output-msg").html("<p>" + phpdata + "</p>"); //DEBuG
                //window.alert(JSON.stringify(phpdata));
                if(parseInt(phpdata['error']) == 0) {
                    document.getElementById("l21").innerHTML = phpdata['l1'] + "%";
                    document.getElementById("l22").innerHTML = phpdata['l2'] + "%";
                    document.getElementById("l23").innerHTML = phpdata['l3'] + "%";
                }else {
                   Materialize.toast("Student Not Registered", 4000);
                }
            }
            });
        }
    });
    
    
    
    $("#viewDetailsBtn").click(function(){
        var course_id = $('#facultySelectioID :selected').val();
        var course_data = $('#facultySelectioID :selected').text();  
        if(course_id != "") {
            $.ajax({
                type: 'POST',
                data: 'course_id=' + course_id,
                url: 'faculty.home.helper.php',
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
    
    $("#export-result-btn").click(function(){
        window.print();
    });

    $("#view-data-btn").click(function(){
         var course_id = $('#courselistiddata :selected').val();
         
         var data = "course_id=" + course_id;
         if(course_id == "") {
             window.alert("Please Select a Course....");
             return;
         }
         $.ajax({
            type: 'POST',
            data: data,
            url: 'view.student.data.php',
            success: function(phpdata) {
                //$("#output-msg").html("<p>" + phpdata + "</p>"); //DEBuG
                $("#tableDiv").html(phpdata);
                
            }
        }); //Ajax
    }); 
    
});