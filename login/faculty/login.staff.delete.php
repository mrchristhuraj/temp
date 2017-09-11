<?php
    session_start();
    
    include_once(__DIR__."/../../includes/sql.config.php");
    $username = $_SESSION['uname'];

   
    $TABLE_NAME = 'COURSE_REG_TABLE';
    

    $regNo = $_REQUEST['rnum'];
    $courseReq = $_REQUEST['creq'];

    
    $sql = "DELETE FROM `$TABLE_NAME` WHERE `STAFF_ID`='$username' AND `STUD_ID`='$regNo' AND `COURSE_NAME`='$courseReq'";

    $db = mysqli_query($link,$sql);

    echo $db;

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));



?>