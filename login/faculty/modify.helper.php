<?php
    session_start();
    include_once(__DIR__."/../../includes/sql.config.php");

    $staffID = $_SESSION['uname'];
    $facultyID = "FACULTY_$staffID";
    $studentID = trim($_REQUEST['studentID']);
    if(strlen($studentID) == 0) {
        echo "Student ID Cannot Be Left Blank";
        exit;
    }

    $sql = "SELECT * FROM `$facultyID` WHERE `STUD_ID` = '$studentID'";

    $db = mysqli_query($link,$sql);
    if(!$db)
        die("Failed to Load: ".mysqli_error($link));
    if(mysqli_num_rows($db) == 0) {
        echo "No Such Student Is Present!";
        exit;
    }

    if(strlen(trim($_REQUEST['password'])) < 8) {
        echo "Password Should have 8 Charaters";
        exit;
    }

    if(trim($_REQUEST['password']) != trim($_REQUEST['password2'])) {
        echo "Password Doesn't Match!";
        exit;
    }

    $sql = "UPDATE `USERS_REQ_TABLE` SET `PASSWORD` = '$password' WHERE `USER_ID` = '$studentID'";
    $db = mysqli_query($link,$sql);
    if(!$db)
        die("Failed to Load: ".mysqli_error($link));

    $password = md5($_REQUEST['password']);

    $sql = "UPDATE `USERS_TABLE` SET `PASSWORD` = '$password' WHERE `USER_ID` = '$studentID'";
    $db = mysqli_query($link,$sql);
    if(!$db)
        die("Failed to Load: ".mysqli_error($link));
    else {
        echo "Password Update Successful";
        exit;
        
    }
    

?>