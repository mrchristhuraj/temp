$(document).ready(function() {
    $('select').material_select();
    var courseSelect = $('#courseSelection');
    var levelSelect = $('#levelSelection');

    var tableDiv = $("#tableDiv");

    $("#reportBtn").click(function(){
        $.ajax({
        type: 'POST',
        data: {
            'course_id': courseSelect.val(),
            'level': levelSelect.val()
        },
        url: 'ranks.helper.php',
        beforeSend: function() {
            tableDiv.html("");
        },
        success: function(phpdata) {
            tableDiv.html(phpdata);
        },
        error: function() {
            console.log("Error (Cantact Admin): " + phpdata);
        }
        });
    });
});