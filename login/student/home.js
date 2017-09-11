$(document).ready(function(){
    $(".choice").click(function(){
        var text = $(this).children().children().html();
        text = text.trim();

        $.ajax({
        type: 'POST',
        data: "text="+text,
        url: 'home.helper.php',
        success: function(phpdata) {
            //$("#output-msg").html("<p>" + phpdata + "</p>"); //DEBuG
        }
        });
        window.location = 'question.php';
    
    });
});