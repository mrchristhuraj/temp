<?php
    session_start();
    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $TABLE_NAME = "COURSE_REG_TABLE";

    
    include_once(__DIR__."/../../includes/sql.config.php");
    $num = $_REQUEST['length'];
    for($i=0;$i<$num;$i++) {
        $course_id = $_REQUEST['COURSE_ID_'.$i];
        $faculty_id = $_REQUEST['FACULTY_ID_'.$i];
        $course_name = $_REQUEST['COURSE_NAME_'.$i];
    
        $req_id = $username.$course_id;

        $sql = "REPLACE INTO $TABLE_NAME (`STAFF_ID`, `COURSE_ID`, `COURSE_NAME`, `STUD_NAME`, `STUD_ID`, `STATUS`, `REQ_ID`) VALUES 
        ('$faculty_id',$course_id,'$course_name','$name','$username',0,'$req_id')";
        $db0 = mysqli_query($link,$sql);
        if(!$db0) 
                die("Failed to Insert: ".mysqli_error($link));
    }
    echo 1;
?>