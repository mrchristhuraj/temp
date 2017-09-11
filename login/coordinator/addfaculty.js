$(document).ready(function() {
    $('select').material_select();
    var current_table;
    var talediv = $("#tableDisplay");
    $.ajax({
            type: 'POST',
            data: 'q=1',
            url: 'facultydisplay.php',
            success: function(response) {
                talediv.html(response);
                current_table = response;
            }
    });

    $("#addFacultyBtn").click(function(){
        var faculty_id = $('#facultySelectioID :selected').val();
        var faculty_data = $('#facultySelectioID :selected').text();        
        if(faculty_id != "") {
            $.ajax({
                type: 'POST',
                data: 'id=' + faculty_id + '&rowData=' + faculty_data,
                url: 'facultyadd.php',
                success: function(response) {
                    if(response == 1) {
                        displayModal("FACULTY ADDED","Faculty (" + faculty_data + ") has been successfuly added");
                    }else if(response == 0) {
                        displayModal("","Faculty Already Present");
                    }else{
                        displayModal("ERROR","Contact Admin");
                    }
                    displayData();
                }
            });
        }else {
            window.alert("FIRST SELECT A FACULTY");
        }
    });

    function displayData() {
         $.ajax({
            type: 'POST',
            data: 'q=1',
            url: 'facultydisplay.php',
            success: function(tableData) {
                talediv.html(tableData);
            }
        });
    }


    function displayModal(heading,text) {
            $('#modalHeading').text(heading);
            $('#modalMsg').text(text);
            $('#modalAlert').openModal();
    }


    $('#getReportBtn').click(function(){
        var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
                action: '../export.data.php'
            }).appendTo(document.body);
        $('<input type="hidden" />').attr({
            name: 'html_data',
            value: current_table
        }).appendTo(f);

    f.submit();
    f.remove();
    });



});