$(document).ready(function(){
    $("#waitingCircle").hide();
    $('#printMsg').hide();
    var editor = CodeMirror(document.getElementById("codeEditor"),{
        mode: "text/x-octave",
        lineNumbers: true,
        value: "fprintf(\"Hello World!\")"
    });

    $('#printMsg').click(function(){
        window.location = '../getReport.php';
    });
    var buttonDisabled = false;
    function setButtons(canSendRequest) {
        var executeButton = $("#evaluateButton");
        var runButton = $("#runButton");
        if(canSendRequest) {
            console.log("Button is Active");
            buttonDisabled = false;
            executeButton.removeClass("disabled");
            runButton.removeClass("disabled");
        }else {
            console.log("Button is Diabled");
            buttonDisabled = true;
            executeButton.addClass("disabled");
            runButton.addClass("disabled");
        }
    }

    function viewProcessing() {
        $("#waitingCircle").show();
        $("#resultMsg").removeClass();
        $("#resultMsg").addClass("login center white-text indigo darken-4");
        setButtons(false);
    }






    $.ajax({
        type: 'POST',
        url: '../flag.checker.php',
        success: function(codedata) {
            if(codedata == 0) {
                console.log("Diasble");

                $("body").on("contextmenu",function(e){
                   window.alert("NOT ALLOWED");
                    return false;
                });

                $('body').bind('cut copy paste', function (e) {
                    e.preventDefault();
                    window.alert("NOT ALLOWED");
                     return false;
                });

                editor.on('paste',function(e){
                    e.preventDefault();
                    console.log('Paste is clicked');
                });

                
                editor.on('beforeChange',function(instance,changeObj) {
                    if(changeObj.origin == "paste") {
                        window.alert("NOT ALLOWED");
                        changeObj.cancel();
                    }
                });

            }
        }

    });


    $("#runButton").click(function(){
        if(buttonDisabled) {
            return;
        }
        var code = editor.getValue('\n');
        var input =document.getElementById("inputText").value;

        $.ajax({
        type: 'POST',
        data:  {
            "code": code,
            "input": input,
        },
        url: 'code.check.elab.php',
        beforeSend: viewProcessing(),
        success: function(phpdata) {
            //console.log(phpdata);
            $("#waitingCircle").hide();
            $("#outputMsg").html("<p> </p>");
            $("#outputMsg").html("<pre>" + phpdata + "</pre>"); //DEBuG
        },
        complete: function()  {
            setButtons(true);
        }
        });
    });

    $("#evaluateButton").click(function(){
        if(buttonDisabled) {
            return;
        }
        var code = editor.getValue('\n');
        var input =document.getElementById("inputText").value;

        $.ajax({
        type: 'POST',
        data:  {
            "code": code,
            "input": input,
        },
        url: 'code.evaluate.elab.php',
        dataType: 'json',
        beforeSend: viewProcessing(),
        success: function(codedata) {
            //console.log(JSON.stringify(codedata));
            $("#waitingCircle").hide();
            $("#outputMsg").html("<p> </p>");
            $("#resultMsg").removeClass();
            $('#printMsg').hide();
            $("#resultMsg").addClass("login center white-text");
            var error_code = parseInt(codedata['error']);
            if(error_code == 1) {
                $("#outputMsg").html("<p>" + codedata['error_msg'] + "</p>");
            }else {
                $("#outputMsg").html("<p>" + "CODE RUN: SUCCESSFULL <br>&nbsp;&nbsp;&nbsp;&nbsp;Execution Time: <span class=\"red-text text-darken-3\">" + codedata['execution_time']+ " Sec</span></p>");
                var result = codedata['score'];
                 $("#resultMsg").html("<p>" + codedata['score']+ "% </p>");
                if(result <= 25) {
                    $("#resultMsg").addClass("red accent-4");
                }else if(result != 100) {
                    $("#resultMsg").addClass("yellow accent-4");
                }else {
                    $("#resultMsg").addClass("green darken-4");
                    $('#printMsg').show();
                }

            }
        },
        complete: function()  {
            setButtons(true);
        }


        });
    });
});
