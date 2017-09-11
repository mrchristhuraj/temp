$(document).ready(function(){
    $("#waitingCircle").hide();
    $('#printMsg').hide();


    $('select').material_select();

    var editor = CodeMirror(document.getElementById("codeEditor"),{
        mode: "text/x-c++src",
        lineNumbers: true,
        value: "#include <stdio.h>\nint main()\n{\n\n\treturn 0;\n}"
    });

    var cDefualtCode = "#include <stdio.h>\nint main()\n{\n\n\treturn 0;\n}";
    var cppDefaultCode = "#include <iostream>\nusing namespace std;\nint main()\n{\n\n\treturn 0;\n}";
    var javaDefaultCode = "import java.io.*;\npublic class TestClass {\n\t public static void main(String[] args) { \n\t\t\n\t}\n}";
    
    $("#selectInput").change(function(){
        window.alert($("#selectInput").val() + " Selected");
        var courseName = $("#selectInput").val();
        var currentValue = editor.getValue();
        if(courseName == "c") {
            if(currentValue == cppDefaultCode || currentValue == javaDefaultCode) {
                editor.setValue(cDefualtCode);
            }else {
                editor.setValue(currentValue);
            }
            editor.setOption("mode","text/x-c++src");
        }else if(courseName == "cpp") {
            if(currentValue == cDefualtCode || currentValue == javaDefaultCode) {
                editor.setValue(cppDefaultCode)
            }else {
                editor.setValue(currentValue);
            }
            editor.setOption("mode","text/x-c++src");
        }else {
            if(currentValue == cppDefaultCode || currentValue == cDefualtCode) {
                editor.setValue(javaDefaultCode);
            }else{
                editor.setValue(currentValue);
            }
            editor.setOption("mode","text/x-java");
        }
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

    $('#printMsg').click(function(){
        window.location = '../getReport.php';
    });

    function viewProcessing() {
        $("#waitingCircle").show();
        $("#resultMsg").removeClass();
        $("#resultMsg").addClass("login center white-text indigo darken-4");
        setButtons(false);
    }

    $("#runButton").click(function(){
        if(buttonDisabled) {
            return;
        }
        var code = editor.getValue('\n');
        var input =document.getElementById("inputText").value;

        $.ajax({
        type: 'POST',
        data: {
            "code": code,
            "input": input,
            "language": $("#selectInput").val()
        },
        url: 'code.check.elab.php',
        beforeSend: viewProcessing(),
        success: function(phpdata) {
            $("#waitingCircle").hide();
            $("#outputMsg").html("<p> </p>");
            $("#outputMsg").html("<p>" + phpdata + "</p>"); //DEBuG
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
        data: {
            "code": code,
            "input": input,
            "language": $("#selectInput").val()
        },
        url: 'code.evaluate.elab.php',
        dataType: 'json',
        beforeSend: viewProcessing(),
        success: function(codedata) {
            $("#waitingCircle").hide();
            $("#outputMsg").html("<p> </p>");
            $("#resultMsg").removeClass();
            $('#printMsg').hide();
            $("#resultMsg").addClass("login center white-text");
            //$(body).append("<p>" + JSON.stringify(codedata) + "</p>"); //DEBuG
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
