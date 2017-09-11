$(document).ready(function(){
  $('#errorMsg').hide();
    $calender = $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 70, // Creates a dropdown of 100 years to control year
    max: true
  });

  //console.log("DEBUG MODE");
    

  $('select').material_select();

  $('#button').click(function(){
    var username = $('#username').val();
    var department_id = $('#departmentList :selected').val();
    var department_data = $('#departmentList :selected').text(); 
    var password = $('#password').val();
    var password_retype = $('#passwordRetype').val();
    var first_name = $('#firstName').val();
    var last_name = $('#lastName').val();
    var email = $('#email').val();
    var picker = $('.datepicker').pickadate('picker');
    var dob = picker.get('select', 'yyyy-mm-dd')
    var mobile = $('#mobilenumber').val();



    $.ajax({
        type: 'POST',
        data: {
          'username': username,
          'dept_id': department_id,
          'dept_name': department_data,
          'password': password,
          'password_retype': password_retype,
          'first_name': first_name,
          'last_name': last_name,
          'email': email,
          'dob': dob,
          'mobile': mobile
        },
        url: 'register.helper.elab.php',
        dataType: 'json',
        beforeSend: function(){
          $('#errorMsg').hide(); 
        },        
        success: function(codedata) {
            $('#errorMsg').html("");
            $('#errorMsg').show(); // Debug
            //$('#errorMsg').append("<p>" + JSON.stringify(codedata) + "</p>"); //DEBuG
            
            if(codedata['error'] == 1) {
              //Error Occured
              $('#errorMsg').show();
              $('#errorMsg').html(codedata['errorMsg']);  
            }else if(codedata['error'] == 0){
              //No Error Occured
              window.location = "../verify.php";
            }else {
              window.alert("Something is Wrong... Contact Admin");
            }
        }
      });
  });
});