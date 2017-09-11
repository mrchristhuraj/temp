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


var session = [];
var topics = [];


var sectors = [];


for (var i = 0; i < 10; i++) {
    sectors[i] = 1;
    colourTwo[i] = UNACTIVATED;
}


var course_name = "";

$.ajax({
    type: 'POST',
    data: 'q=SESSION',
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
    data: ('q=VALUES'),
    url: 'course.get.php',
    dataType: 'json',
    success: function (codedata) {
        //console.log(codedata);
        //$("body").append("<p>"+JSON.stringify(phpdata)+"</p>"); //DEBUG
        //$("body").append("<p>" + JSON.stringify(codedata) + "</p>"); //DEBUG

        var i = 0, j = 0;
        var session_id = parseInt(codedata['id']);

        for (i = 1; i <= 10; i++) {
            for (j = 1; j <= 1; j++) {
                var session_id = parseInt(codedata['id']);
                var num = i-1;
                var session_id = (session_id * 100000) + ((i + 10) * 1000) + (100) + (j + 10);
                var session_id = session_id.toString();
                var status = parseInt(codedata[session_id]);
                if (status === 1) {
                    colourTwo[num] = CURRENT;
                } else if (status === 2) {
                    colourTwo[num] = FINISHED;
                } else {
                    colourTwo[num] = UNATEMPTED;
                }

                if(i === 10 && j ===1) {
                    loadWindow(parseInt(codedata['id']));
                }
            }
        }
    }
});

for (var i = 0; i < 10; i++) {
    session[i] = 1;
    colourOne[i] = '#ffebee';
}




var questionListOne = [];




//Onload


function loadWindow(id) {
    id = parseInt(id);
    console.log(id);
    var count = 0;
    for (var i = 11; i < 21; i++) {
        for (var j = 11; j < 12; j++) {
            questionListOne[count] = "" + (id * 100000 + i * 1000 + 100 + j);
            count++;
        }
    }

    console.log(count);


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
            radius: 205,
            tooltipsEvent: 'onmousemove',
            variantDonutWidth: 80,
            tooltips: topics,
            variant: 'donut',
            strokestyle: '#000', //Border Color
            bounding: false,

        }
    });
    wheelOne.draw();


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
            variantDonutWidth: 120,
            tooltips: questionListOne,
            variant: 'donut',
            bounding: false,
            strokestyle: '#00',
        }
    });

    wheelTwo.on('click', function (e, shape) {
        displayResult(e, shape, 1,true);
    });
    wheelTwo.draw();

    


}


function displayResult(e, shape, wheelID,flag) {
    if(flag) {
        var language = $("#hidden").text().toLowerCase();
        window.location = "code/"+language+"/"+ language + ".code.php?id=" + encodeURIComponent(wheelID) + "&value=" + encodeURIComponent(shape['index']*10);
    }
}