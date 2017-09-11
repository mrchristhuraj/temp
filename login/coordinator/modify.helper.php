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

    $sql = "SELECT * FROM `USERS_TABLE` WHERE `USER_ID` = '$studentID'";

    $db = mysqli_query($link,$sql);
    if(!$db)
        die("Failed to Load: ".mysqli_error($link));
    if(mysqli_num_rows($db) == 0) {
        echo "No Such User Is Present!";
        exit;
    }
    $row = mysqli_fetch_assoc($db);
    if(!($row['ROLE'] == 'F' || $row['ROLE'] == 'S')) {
        echo "Premission Denied...";
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