$(document).ready(function() {

    var UNATEMPTED = '#FA1717';
    var UNACTIVATED = '#90A4AE';
    var CURRENT = '#CDDC39';
    var FINISHED = '#22aa22';

    var colourAccentOne = '#ffebee';
    var colourAccentTwo = '#ffebee';

    var colourOne = [];
    var colourTwo = [];
    var colourThree = [];
    var colourFour = [];

    var countL1 = 0,countL2 = 0,countL3 = 0;

    var session = [];
    var topics = [];

    var course_name;


    var sectors = [];

    $('select').material_select();
    $("#courseSelectionDiv").hide();
    $("#canvasSection").hide();
    $("#studentSelect").change(function() {
        var studentID = $("#studentSelect").val();
        $.ajax({
            type: 'POST',
            data: {
                'studentID': studentID
            },
            url: 'get.student.course.php',
            success: function(phpdata) {
                //$("#output-msg").html("<p>" + phpdata + "</p>"); //DEBuG
                $("#courseSelectionDiv").show();
                $("#courseSelect").html(phpdata);
                $('select').material_select();
            }
        }); //Ajax
    });


    $("#viewDetailsButton").click(function() {
        course_name = $("#courseSelect").text();
            var canvas = document.getElementById('graphCanvas');
            RGraph.Clear(canvas);


        var studentID = $("#studentSelect :selected").val();
        var courseID = $("#courseSelect :selected").val();
        if(studentID == null || studentID == 0) {
            window.alert("Select a Valid Student");
            return;
        }
        //console.log(studentID);
        $("#canvasSection").show();
        renderCanvas(studentID,courseID);
    });

    function renderCanvas(studentID,courseID) {
           for (var i = 0; i < 100; i++) {
            sectors[i] = 1;
            colourTwo[i] = UNACTIVATED;
            colourThree[i] = colourFour[i] = UNATEMPTED;
            colourFour[i] = colourAccentTwo;
            colourThree[i] = colourAccentOne;
        }

        $.ajax({
            type: 'POST',
            data: {
                'q': 'SESSION',
                'course_id': courseID,
                'uname': studentID
            },
            url: 'course.get.php',
            dataType: 'json',
            success: function (phpdata) {
                course_name = phpdata['course_name'];
                for (var i = 0; i < 10; i++) {
                    topics[i] = '<b>Session ' + (i + 1) + '</b><br/>' + phpdata[i];
                }
            }
        });

         $.ajax({
            type: 'POST',
            data: {
                'q': 'VALUES',
                'course_id': courseID,
                'uname': studentID
            },
            url: 'course.get.php',
            dataType: 'json',
            success: function (codedata) {
                //console.log(JSON.stringify(codedata));
                var i = 0, j = 0;
                var session_id = parseInt(codedata['id']);
                        countL1 = 0;
                        countL2 = 0;
                        countL3 = 0;

                for (i = 1; i <= 10; i++) {
                    for (j = 1; j <= 10; j++) {
                        var session_id = parseInt(codedata['id']);
                        var num = (i - 1) * 10 + j - 1;
                        var session_id = (session_id * 100000) + ((i + 10) * 1000) + (100) + (j + 10);
                        var session_id = session_id.toString();
                        var status = parseInt(codedata[session_id]);
                        if (status === 1) {
                            colourTwo[num] = CURRENT;
                        } else if (status === 2) {
                            colourTwo[num] = FINISHED;
                            countL1++;
                        } else {
                            colourTwo[num] = UNATEMPTED;
                        }
                    }
                }

                for (i = 1; i <= 10; i++) {
                    for (j = 1; j <= 10; j++) {
                        var session_id = parseInt(codedata['id']);
                        var num = (i - 1) * 10 + j - 1;
                        var session_id = (session_id * 100000) + ((i + 10) * 1000) + (200) + (j + 10);
                        var session_id = session_id.toString();
                        var status = parseInt(codedata[session_id]);
                        if (status === 1) {
                            colourThree[num] = CURRENT;
                        } else if (status === 2) {
                            colourThree[num] = FINISHED;
                            countL2++;
                        } else {
                            colourThree[num] = UNATEMPTED;
                        }
                    }
                }

                for (i = 1; i <= 10; i++) {
                    for (j = 1; j <= 10; j++) {
                        var session_id = parseInt(codedata['id']);
                        var num = (i - 1) * 10 + j - 1;
                        var session_id = (session_id * 100000) + ((i + 10) * 1000) + (300) + (j + 10);
                        var session_id = session_id.toString();
                        var status = parseInt(codedata[session_id]);
                        if (status === 1) {
                            colourFour[num] = CURRENT;
                        } else if (status === 2) {
                            colourFour[num] = FINISHED;
                            countL3++;
                        } else {
                            colourFour[num] = UNATEMPTED;
                        }

                        if(i === 10 && j === 10) {
                            loadWindow(parseInt(courseID));
                        }
                    }
                }

                $("#L1Text").html(countL1);
                $("#L2Text").html(countL2);
                $("#L3Text").html(countL3);
            }
        });
    } //Render Function


var questionListOne = [];
var questionListTwo = [];
var questionListThree = [];

    function loadWindow(id) {
        //console.log(JSON.stringify(colourOne));
        for (var i = 0; i < 10; i++) {
            session[i] = 1;
            colourOne[i] = '#ffebee';
        }
        var count = 0;
        for (var i = 11; i < 21; i++) {
            for (var j = 11; j < 21; j++) {
                questionListOne[count] = "" + (id * 100000 + i * 1000 + 100 + j);
                questionListTwo[count] = "" + (id * 100000 + i * 1000 + 200 + j);
                questionListThree[count] = "" + (id * 100000 + i * 1000 + 300 + j);
                count++;
            }
        }

        var title = new RGraph.Drawing.Circle({
            id: 'graphCanvas',
            x: 450,
            y: 450,
            radius: 100,
            options: {
                fillstyle: '#FFF', //=========//Label Circle
                textAccessible: true,
                textSize: 14,
            }
        });
        title.draw();

        var wheelOne = new RGraph.Pie({
            id: 'graphCanvas',
            data: session,
            options: {
                linewidth: 1,
                colors: colourOne,
                tooltipsHighlight: false,
                radius: 290,
                tooltipsEvent: 'onmousemove',
                variantDonutWidth: 180,
                tooltips: topics,
                variant: 'donut',
                strokestyle: '#000', //Border Color
                bounding: false,

            }
        });
        wheelOne.draw();

        course_name = $("#courseSelect").text();
      
        var titleText = new RGraph.Drawing.Text({
        id: 'graphCanvas',
        x: 450,
        y: 450,
        text: course_name,
        options: {
            colors: ['#000'],
            bold: true,
            valign: 'center',
            halign: 'center',
            marker: false,
            size: 18,
        }
    });

    titleText.draw();

        var wheelTwo = new RGraph.Pie({
            id: 'graphCanvas',
            data: sectors,
            options: {
                linewidth: 1.2,
                colors: colourTwo,
                tooltipsEvent: 'onmousemove',
                tooltipsHighlight: false,
                radius: 330,
                variantDonutWidth: 40,
                tooltips: questionListOne,
                variant: 'donut',
                bounding: false,
                strokestyle: '#00',
            }
        });
        wheelTwo.draw();

        var wheelThree = new RGraph.Pie({
            id: 'graphCanvas',
            data: sectors,
            options: {
                colors: colourThree,
                linewidth: 1,
                tooltipsHighlight: false,
                radius: 370,
                variantDonutWidth: 40,
                tooltipsEvent: 'onmousemove',
                tooltips: questionListTwo,
                variant: 'donut',
                bounding: false,
                strokestyle: '#000',
            }
        });
        wheelThree.draw();

        var wheelFour = new RGraph.Pie({
            id: 'graphCanvas',
            data: sectors,
            options: {
                linewidth: 0,
                colors: colourFour,
                tooltipsHighlight: false,
                radius: 410,
                tooltipsEvent: 'onmousemove',
                variantDonutWidth: 40,
                tooltips: questionListThree,
                variant: 'donut',
                bounding: true,
                strokestyle: '#000',

            }
        });
        wheelFour.draw();
    }

 

  });//Main Function