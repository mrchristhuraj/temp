$(document).ready(function(){
    $('.falseBtn').click(function() {
        var rowIndex = (this.parentElement.parentElement.parentElement.rowIndex)-1;
        var regNo = document.getElementById("tBody").rows[rowIndex].cells[0].innerHTML;
        var stud_name = document.getElementById("tBody").rows[rowIndex].cells[1].innerHTML;
        var courseReq = document.getElementById("tBody").rows[rowIndex].cells[2].innerHTML;
        var data = 'rnum=' + regNo + '&creq=' + courseReq + '&studName=' + stud_name;
        //Deleting table
        $.ajax({
            type: 'POST',
            data: data,
            url: 'login.staff.delete.php',
            beforeSend: function() {
                document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = 
                '<div id=\"preloader\" class=\"preloader-wrapper small active\"><div class=\"spinner-layer spinner-green-only\"><div class=\"circle-clipper left\"><div class=\"circle\"></div></div><div class=\"gap-patch\"><div class=\"circle\"></div></div><div class=\"circle-clipper right\"><div=\"circle\"></div></div></div></div>';
            },
            success: function(responseID) {
                $("body").append("<p>"+responseID+"</p>"); //DEBUG
                if(responseID === "1") {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"red-text text-accent-4\">REJECTED</p>";
                }else if(responseID === "0") {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"red-text text-accent-4\">FAILED</p>";
                } else {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"red-text text-accent-4\">ERROR</p>";
                }          
            }
        });
    });
                         
    $('.trueBtn').click(function() {
        var rowIndex = (this.parentElement.parentElement.parentElement.rowIndex)-1;
        var regNo = document.getElementById("tBody").rows[rowIndex].cells[0].innerHTML;
        var stud_name = document.getElementById("tBody").rows[rowIndex].cells[1].innerHTML;
        var courseReq = document.getElementById("tBody").rows[rowIndex].cells[2].innerHTML;
        var data = 'rnum=' + regNo + '&creq=' + courseReq + '&studName=' + stud_name;
        
        $.ajax({
            type: 'POST',
            data: data,
            url: 'login.staff.add.php',
            beforeSend: function() {
                document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = 
                '<div id=\"preloader\" class=\"preloader-wrapper small active\"><div class=\"spinner-layer spinner-green-only\"><div class=\"circle-clipper left\"><div class=\"circle\"></div></div><div class=\"gap-patch\"><div class=\"circle\"></div></div><div class=\"circle-clipper right\"><div=\"circle\"></div></div></div></div>';
            },
            success: function(responseID) {
                //$("body").append("<p>"+responseID+"</p>"); //DEBUG
                if(responseID === "1") {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"green-text text-darken-2\">ACCEPTED</p>";
                }else if(responseID === "0") {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"red-text text-accent-4\">FAILED</p>";
                } else {
                    document.getElementById("tBody").rows[rowIndex].cells[3].innerHTML = "<p class=\"red-text text-accent-4\">ERROR</p>";
                }  
                
            }

        });
    
        
    });
   
});