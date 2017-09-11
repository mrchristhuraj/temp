$(document).ready(function(){
  $('#errorMsg').hide();
    $calender = $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 70, // Creates a dropdown of 100 years to control year
    max: true
  });


  $('select').material_select();

  $('#button').click(function(){
    var password = $('#password').val();
    var password_retype = $('#passwordRetype').val();
    var email = $('#email').val();
    var picker = $('.datepicker').pickadate('picker');
    var dob = picker.get('select', 'yyyy-mm-dd')
    var mobile = $('#mobilenumber').val();



    $.ajax({
        type: 'POST',
        data: {
          'password': password,
          'password_retype': password_retype,
          'email': email,
          'dob': dob,
          'mobile': mobile
        },
        url: 'edit.helper.elab.php',
        dataType: 'json',
        beforeSend: function(){
          $('#errorMsg').hide();
        },
        success: function(codedata) {
            $('#errorMsg').html(codedata);
            $('#errorMsg').show(); // Debug
            //$('#errorMsg').append("<p>" + JSON.stringify(codedata) + "</p>"); //DEBuG

            if(codedata['error'] == 1) {
              //Error Occured
              $('#errorMsg').show();
              $('#errorMsg').html(codedata['errorMsg']);
            }else if(codedata['error'] == 0){
              //No Error Occured
              window.location = "../home.php";
            }else {
              window.alert("Something is Wrong... Contact Admin");
            }
        }
      });
  });

});
