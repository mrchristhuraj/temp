$(document).ready(function() {
    $('select').material_select();
    $('#question_id_div').hide();

    
    var status = 0;

    var test_case_1_input = $('#testcase1_input').val("0");
    var test_case_1_output = $('#testcase1_output').val("0");
    var test_case_2_input = $('#testcase2_input').val("0");
    var test_case_2_output = $('#testcase2_output').val("0");
    var test_case_3_input = $('#testcase3_input').val("0");
    var test_case_3_output = $('#testcase3_output').val("0");
    var test_case_4_input = $('#testcase4_input').val("0");
    var test_case_4_output = $('#testcase4_output').val("0");
    var test_case_5_input = $('#testcase5_input').val("0");
    var test_case_5_output = $('#testcase5_output').val("0");

    $('.toggle_switch').change(function(){
        if($('.toggle_switch :checked').val()) {
console.log("Status is 1");
            status = 1;
            $('#question_id_div').show();
            $('#main_form_div').hide();
            $('#add_question_button_div').hide();
            $('#session_div').hide();
            $('#level_div').hide();
            $('#question_id').val("");
            $('#addQuestionBtn').html("UPDATE QUESTION");
        }else {
console.log("Status is 0");
            $('#question_id_div').hide();
            $('#main_form_div').show(); 
            $('#add_question_button_div').show();
            $('#session_div').show();
            $('#level_div').show();
            $('#addQuestionBtn').html("ADD QUESTION");            
            status = 0;
        }
    });


    $('#getDetailsButton').click(function(){
        var q_id = $('#question_id').val();
        if(q_id !== "") {
            setBaseData();
        }else {
            window.alert("Enter A Question ID");
        }
    });

    $('#addQuestionBtn').click(function(){
        var question_name = $('#question_name').val();
        var question_desc = $('#question_description').val();
        var test_case_1_input = $('#testcase1_input').val();
        var test_case_1_output = $('#testcase1_output').val();
        var test_case_2_input = $('#testcase2_input').val();
        var test_case_2_output = $('#testcase2_output').val();
        var test_case_3_input = $('#testcase3_input').val();
        var test_case_3_output = $('#testcase3_output').val();
        var test_case_4_input = $('#testcase4_input').val();
        var test_case_4_output = $('#testcase4_output').val();
        var test_case_5_input = $('#testcase5_input').val();
        var test_case_5_output = $('#testcase5_output').val();

        if(status) {
            $.ajax({
            type: 'POST',
            data: {
                question_id: $('#question_id').val(),
                question_name: (question_name),
                question_desc: (question_desc),
                test_case_1_input: (test_case_1_input),
                test_case_2_input: (test_case_2_input),
                test_case_3_input: (test_case_3_input),
                test_case_4_input: (test_case_4_input),
                test_case_5_input: (test_case_5_input),
                test_case_1_output: (test_case_1_output),
                test_case_2_output: (test_case_2_output),
                test_case_3_output: (test_case_3_output),
                test_case_4_output: (test_case_4_output),
                test_case_5_output: (test_case_5_output),
                action : "SET"
            },
            url: 'addquestion.helper.php',
            dataType: 'json',            
            success: function(phpdata) {
                var response = parseInt(phpdata['error']);
                if(response == 0) {
                    window.alert("QUESTION UPADTED");
                }else if(response == 1) {
                    window.alert("QUESTION UPDATION FAILED");
                }else{
                    window.alert("ERROR:: CONTACT ADMIN" + phpdata['error_msg']);                        
                }

                //$('body').append("<p>" +  JSON.stringify(response) + "</p>");
            }
            });              
        }else {
            $.ajax({
            type: 'POST',
            data: getBaseData("POST"),
            url: 'addquestion.helper.php',
            dataType: 'json',            
            success: function(phpdata) {
                var response = parseInt(phpdata['error']);
                if(response == 0) {
                    window.alert("QUESTION ADDED");
                }else if(response == 1) {
                    window.alert("QUESTION ADDITION FAILED");
                }else{
                    window.alert("ERROR:: CONTACT ADMIN" + phpdata['error_msg']);                        
                }

                //console.log(JSON.stringify(phpdata));
            }
            });           
        }

    });


    function setBaseData() {
        $.ajax({
            type: 'POST',
            data: 'action=GET' + '&q_id=' + $('#question_id').val(),
            url: 'addquestion.helper.php',
            dataType: 'json',            
            success: function(response) {
                //$('body').append("<p>" +  JSON.stringify(response) + "</p>");
                if(response['error'] == 0) {
                    $('#main_form_div').show(); 
                    $('#add_question_button_div').show();
                    //GOOD
                    var question_name = $('#question_name').val(response['q_name']);
                    var question_desc = $('#question_description').val(response['q_desc']);
                    var test_case_1_input = $('#testcase1_input').val(response['tc_1_in']);
                    var test_case_1_output = $('#testcase1_output').val(response['tc_1_out']);
                    var test_case_2_input = $('#testcase2_input').val(response['tc_2_in']);
                    var test_case_2_output = $('#testcase2_output').val(response['tc_2_out']);
                    var test_case_3_input = $('#testcase3_input').val(response['tc_3_in']);
                    var test_case_3_output = $('#testcase3_output').val(response['tc_3_out']);
                    var test_case_4_input = $('#testcase4_input').val(response['tc_4_in']);
                    var test_case_4_output = $('#testcase4_output').val(response['tc_4_out']);
                    var test_case_5_input = $('#testcase5_input').val(response['tc_5_in']);
                    var test_case_5_output = $('#testcase5_output').val(response['tc_5_out']);


    Materialize.updateTextFields();

                }else if(response['error'] == 2) {
                    window.alert("Question ID Not Present" + response['temp']);
                }else {
                    window.alert("ERROR:: CONTACT ADMIN" + response['error_msg']);  
                }
            }
        });    
    }

    function getBaseData(str) {
        var question_name = $('#question_name').val();
        var session_id = $('#session_id :selected').val();

        var session_name = $('#session_id :selected').text();
        var level_id = $('#level_id :selected').val();
        
        if(session_id == "") {
            window.alert
        }
        var question_desc = $('#question_description').val();
        var test_case_1_input = $('#testcase1_input').val();
        var test_case_1_output = $('#testcase1_output').val();
        var test_case_2_input = $('#testcase2_input').val();
        var test_case_2_output = $('#testcase2_output').val();
        var test_case_3_input = $('#testcase3_input').val();
        var test_case_3_output = $('#testcase3_output').val();
        var test_case_4_input = $('#testcase4_input').val();
        var test_case_4_output = $('#testcase4_output').val();
        var test_case_5_input = $('#testcase5_input').val();
        var test_case_5_output = $('#testcase5_output').val();
        var data = {
            question_name: (question_name),
            session_id: (session_id),
            session_name: (session_name),
            level_id: level_id,
            question_desc: (question_desc),
            test_case_1_input: (test_case_1_input),
            test_case_2_input: (test_case_2_input),
            test_case_3_input: (test_case_3_input),
            test_case_4_input: (test_case_4_input),
            test_case_5_input: (test_case_5_input),
            test_case_1_output: (test_case_1_output),
            test_case_2_output: (test_case_2_output),
            test_case_3_output: (test_case_3_output),
            test_case_4_output: (test_case_4_output),
            test_case_5_output: (test_case_5_output),
            action : str

        }
    
        return data;
    }

    

});
