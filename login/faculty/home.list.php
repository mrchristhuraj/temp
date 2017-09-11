<?php
    session_start();
    $username =  $_SESSION['uname'];
    $name = $_SESSION['name'];
    
    include_once(__DIR__."/../../includes/sql.config.php");

    $sql = "SELECT COURSE_NAME FROM `course_reg_table` WHERE STUD_ID = '$username' AND STATUS = 1;";

    $db = mysqli_query($link,$sql);

    if(!$db)
            die("Failed to Load: ".mysqli_error($link));

    $stud_id = $_REQUEST['studid'];
    $course_name = $_REQUEST['coursename'];

    $sql= "SELECT LEVEL_1,LEVEL_2,LEVEL_3 FROM `FACULTY_$username` WHERE `STUD_ID` = '$stud_id' AND `COURSE_NAME` = '$course_name'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
        die("Failed to Insert: $sql".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);


    $final_result = Array();

    if(mysqli_num_rows($db) == 0) {
        $final_result['error'] = 1;
        echo json_encode($final_result);
        exit;
    }


    $final_result['error'] = 0;

    $final_result['l1'] = $row['LEVEL_1'];
    $final_result['l2'] = $row['LEVEL_2'];
    $final_result['l3'] = $row['LEVEL_3'];

    echo json_encode($final_result);
?>