<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'F') {
        echo "ERROR IN SESSION";
        exit;
    }
    include_once(__DIR__."/../../includes/sql.config.php");
    $username =  $_SESSION['uname'];
    $name = $_SESSION['name'];
    $TABLE_NAME_NEW = "FACULTY_".$username;
    $studentID = $_REQUEST['studentID'];
    $sql_regid = "SELECT DISTINCT COURSE_NAME,COURSE_ID FROM $TABLE_NAME_NEW WHERE STUD_ID = '$studentID'";
    $db_regid = mysqli_query($link,$sql_regid);
    if(!$db_regid)
        die("Failed to Insert: ".mysqli_error($link));
    if(mysqli_num_rows($db_regid) > 0) {
        if(mysqli_query($link,$sql_regid)) {
            while($row = mysqli_fetch_assoc($db_regid)){
                $temp1 = $row['COURSE_NAME'];
                $temp2 = $row['COURSE_ID'];
                echo "<option value=\"".$temp2."\">".$temp1."</option>";
            }
        }
    }
?>