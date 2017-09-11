$(document).ready(function() {
    $('select').material_select();
    var talediv = $("#tableDisplay");
    var faculty_list = $('#facultyList');
    talediv.html("");
    $('#facultyList').hide();
    $('#getReportBtn').hide();

    var loading = '<div class="center"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div="circle"></div></div></div></div></div>';

    $('#viewTableBtn').hide();

    $('#subjectSelectioID').change(function() {
        var course_id = $('#subjectSelectioID :selected').val();
        $.ajax({
            type: 'POST',
            data: 'course_id=' + course_id,
            url: 'report.helper.php',
            beforeSend: function() {
                $('#facultyList').hide();
                $('#viewTableBtn').hide();
                $('#getReportBtn').hide();
            },
            success: function(phpdata) { 
                $('#facultyList').show();
                faculty_list.html(phpdata);
                $('select').material_select();

                $('#facultySelectioID').change(function() {
                    var faculty_id = $('#facultySelectioID :selected').val();
                    $('#viewTableBtn').show();
                });
            }
        });
    });

    $('#viewTableBtn').click(function(){
        var course_id = $('#subjectSelectioID :selected').val();
        var faculty_id = $('#facultySelectioID :selected').val();
        talediv.html(loading);
        displayTable(course_id,faculty_id);

    });


    var current_table;

    function displayTable(course_id,faculty_id) {
        $.ajax({
            type: 'POST',
            data: 'faculty_id=' + faculty_id + '&course_id=' + course_id,
            url: 'report.display.php',
            success: function(tableData) {
                talediv.html(tableData);
                current_table = tableData;
                $('#getReportBtn').show();
            }
        });
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