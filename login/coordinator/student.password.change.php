<?php
session_start();
$username = $_SESSION['uname'];
$name = $_SESSION['name'];
$faculty_id = $_REQUEST['id'];
$course_name = $_SESSION['course_name'];
$course_id = $_SESSION['course_id'];
$TABLE_NAME = "users_req_table";
$TABLE_NAME_USERS = "users_table";


$faculty_data = $_REQUEST['rowData'];
$faculty_name = trim(str_replace("$faculty_id - ","",$faculty_data));
$password = trim($_REQUEST['password']);
if ($password == null || strlen($password) < 8 || strlen($password) > 30) {
    echo ("Password should be 8-30 characters");
    return;
}


include_once(__DIR__."/../../includes/sql.config.php");

$sql = "SELECT * FROM `$TABLE_NAME` WHERE `UNIQUE_ID` = '$faculty_id'";
$db = mysqli_query($link,$sql);

if(!$db)
    die("Failed to Insert: ".mysqli_error($link));

if(mysqli_num_rows($db) > 0) {
    if(mysqli_query($link,$sql)) {
        while($row = mysqli_fetch_assoc($db)) {
            $studentID = $row['USER_ID'];

            // Update password in USERS TABLE
            $sql2 = "UPDATE `$TABLE_NAME` SET `PASSWORD` = '$password' WHERE `USER_ID` = '$studentID'";
            $db2 = mysqli_query($link,$sql2);
            if(!$db2)
                die("Failed to Update Student Password in USERS REQ".mysqli_error($link));

            // Update password in USERS REQ TABLE
            $password = md5($password);
            $sql2 = "UPDATE `$TABLE_NAME_USERS` SET `PASSWORD` = '$password' WHERE `USER_ID` = '$studentID'";
            $db2 = mysqli_query($link,$sql2);
            if(!$db2)
                die("Failed to Update Student Password in USERS RECORD".mysqli_error($link));

        }
    }
}

echo "Password Successfully Updated";
?>