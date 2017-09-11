<?php
    session_start();
    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $faculty_id = $_REQUEST['id'];
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];
    $TABLE_NAME = "coordinator_".$course_id."";


    $faculty_data = $_REQUEST['rowData'];
    $faculty_name = trim(str_replace("$faculty_id - ","",$faculty_data));

    
    include_once(__DIR__."/../../includes/sql.config.php");

    $sql = "INSERT INTO `$TABLE_NAME` (`FACULTY_NAME`, `FACULTY_ID`, `COURSE_ID`) VALUES ('$faculty_name','$faculty_id',$course_id)";
    $db = mysqli_query($link,$sql);
    if(!$db) 
         echo 0;
    else
        echo 1;


?> 