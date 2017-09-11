$(document).ready(function() {
    $('select').material_select();
    var talediv = $("#tableDisplay");
    talediv.html("");

    $('#getReportBtn').hide();
var current_html = "";
    $("#addFacultyBtn").click(function(){

    $('#getReportBtn').hide();
        var faculty_id = $('#facultySelectioID :selected').val();
        var faculty_data = $('#facultySelectioID :selected').text();     
        if(faculty_id != "") {
           $.ajax({
                type: 'POST',
                data: 'id=' + faculty_id + '&rowData=' + faculty_data,
                url: 'studentreport.php',
                success: function(tableData) {
                    talediv.html(tableData);
                    current_html = tableData;
                    $('#getReportBtn').show();
                }
            });
        }else {
            window.alert("FIRST SELECT A FACULTY");
        }
    });


$('#getReportBtn').click(function(){
        var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
                action: '../export.data.php'
            }).appendTo(document.body);
        $('<input type="hidden" />').attr({
            name: 'html_data',
            value: current_html
        }).appendTo(f);

    f.submit();
    f.remove();
    });


});