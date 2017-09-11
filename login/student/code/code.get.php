<?php

    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION"; 
        exit;
    }

    
    $username =  $_SESSION['uname'];
    $name = $_SESSION['name'];
    $sequence_id = $_SESSION['sequence_id'];
    $course_name = trim($_SESSION['course_name']);
    $TABLE_NAME = "STD_DB_".$username;


    include_once(__DIR__."/../../../includes/sql.config.php");

    $sql = "SELECT * FROM `$TABLE_NAME` WHERE SEQUENCE_ID = '$sequence_id' LIMIT 1;";
    $db = mysqli_query($link,$sql);
    if(!$db)
            die("Failed to Load: ".mysqli_error($link));

     if(mysqli_num_rows($db)  == 0) {
         die("NO DATA PRESENT");
     }else {
        $row = mysqli_fetch_assoc($db);
        echo $row['CODE'];
     }


?>