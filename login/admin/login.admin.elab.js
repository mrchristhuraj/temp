$(document).ready(function(){
    $("#sqlExecute").click(function() {
        var sqlCommand = $("#textarea1").val();
        $.ajax({
            type: 'POST',
            data: {
                'mode': 'SQL',
                'command': sqlCommand
            },
            url: 'sql.execute.helper.php',
            beforeSend: function() {
                $("#sqlConsole").html("");
            },
            success: function(phpdata) {
                //console.log(phpdata);
                $("#sqlConsole").html(phpdata);
            }
        });
    });

}); 