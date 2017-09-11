 $(document).ready(function() {
    $('select').material_select();
    $('select').prop('disabled',true);
    $('select').material_select();
    opt_courses = [];
    
    $("input:checkbox:checked").each(function(){
                yourArray.push($(this).val());
    });

    $('input[type=checkbox]').change(function() {
        var id = $(this).attr('id');
        var isChecked = $(this).prop('checked');
        if(isChecked) {
            $("#SELECT_"+id).prop('disabled',false);
            $('select').material_select();

        }else {
            $("#SELECT_"+id).prop('disabled',true);
            $('select').material_select();
        }
    });


    $('#registerBtn').click(function() {
        opt_courses = [];
        course_name = [];
        $("input:checkbox:checked").each(function(){
            opt_courses.push($(this).attr('id'));
            course_name.push($(this).parent().next().text());
        });
        var data = 'length=' + opt_courses.length
        for(var i=0;i<opt_courses.length;i++) {
            var course_id = opt_courses[i];
            var faculty_id = $("#SELECT_"+ course_id +" :selected").val();
            if(!faculty_id) {
                window.alert("Please Select faclty for the course");
                return;
            }
            data = data + "&COURSE_ID_"+ i + "="+ course_id + "&FACULTY_ID_"+ i + "=" + faculty_id + '&COURSE_NAME_' + i + "=" + course_name[i];
        }

        var confirm_flag = confirm("Are You Sure To Proceed?");
        if(confirm_flag) {
            $.ajax({
                type: 'POST',
                data: data,
                url: 'request.helper.php',
                //dataType: 'json',
                //beforeSend: ,        
                success: function(codedata) {
                    if(codedata == 1) {
                        Materialize.toast("Request successfully Send...", 4000);
                        window.location = "home.php";
                    }else {
                        Materialize.toast("SOMETHING HAPPENED: " + codedata, 4000);
                    }
                }
            }); 
        }else {
            Materialize.toast("Request Cancelled by User!", 4000);
        }


    });
  });
       