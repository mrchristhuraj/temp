$(document).ready(function() {
  $('select').material_select();


   $('#registerStudentButton').click(function(){
    var username = $('#username').val();
    var department_id = $('#departmentList :selected').val();
    var department_data = $('#departmentList :selected').text();

    var first_name = $('#firstName').val();
    var last_name = $('#lastName').val();

    $.ajax({
        type: 'POST',
        data: {
          'username': username,
          'dept_id': department_id,
          'dept_name': department_data,
          'first_name': first_name,
          'last_name': last_name
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
              $('#errorMsg').show();
              $('#errorMsg').html("Student Registered");  

                displayTable();

            }else {
              window.alert("Something is Wrong... Contact Admin");
            }
        }
      });
  });


   var contentDiv = $("#studentContentDiv");
   function displayTable() {
       $.ajax({
        type: 'POST',
        url: 'register.student.helper.elab.php',
        beforeSend: function(){
          $('#errorMsg').hide(); 
        },        
        success: function(codedata) {
          contentDiv.html(codedata);
        }
      });
   }


   displayTable();

    var filePattern =  /\.([0-9a-z]+)(?:[\?#]|$)/i;

    function formatSizeUnits(bytes){
        if      (bytes>=1073741824) {bytes=(bytes/1073741824).toFixed(2)+' GB';}
        else if (bytes>=1048576)    {bytes=(bytes/1048576).toFixed(2)+' MB';}
        else if (bytes>=1024)       {bytes=(bytes/1024).toFixed(2)+' KB';}
        else if (bytes>1)           {bytes=bytes+' bytes';}
        else if (bytes==1)          {bytes=bytes+' byte';}
        else                        {bytes='0 byte';}
        return bytes;
    }

   $('#registerStdBulkBtn').click(function () {
       var nos = $('#inputField').get(0).files.length;
       if(nos == 0) {
           window.alert("Please select a file to upload");
           return;
       }else if(nos != 1) {
           window.alert("Only File Can be Uploaded");
           return;
       }

       var uploadFile = $('#inputField').get(0).files[0];
       var size = formatSizeUnits(uploadFile.size);

       var fileName = uploadFile.name;
       var extension = fileName.match(filePattern);

       if(!extension) {
           window.alert("Not a Valid File.");
           return;
       }

       if(uploadFile.size > 3145728) {
           window.alert("File can't exceed more than 3 MB.");
           return;
       }


       if( !(extension[0] == '.csv')) {
           window.alert("Only .csv Can be Uploaded");
           return;
       }

       var bool = window.confirm("Do want to upload " + uploadFile.name + " (" + size + ") ?");

       if(!bool) return;

       var formData = new FormData();
       formData.append('file', uploadFile);
       $.ajax({
           url: './bulk.register.helper.php',
           data: formData,
           type: 'POST',
           success: function (e) {
               $("#bulkRegisterCodeDiv").html(e);


               displayTable();
           },
           error: function (e) {
               alert('error ' + e.message);
           },
           cache: false,
           contentType: false,
           processData: false
       });
   });


    $("#registerModalOpen").click(function () {
        $('#modalBulk').openModal();
    });
});