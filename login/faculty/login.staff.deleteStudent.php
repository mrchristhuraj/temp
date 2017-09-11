<?php
    session_start();
    
    include_once(__DIR__."/../../includes/sql.config.php");
    $username = $_SESSION['uname'];

   
    $TABLE_NAME = 'COURSE_REG_TABLE';
    

    $regNo = $_REQUEST['rnum'];
    $courseReq = $_REQUEST['creq'];

    
    $sql = "DELETE FROM `$TABLE_NAME` WHERE `STAFF_ID`='$username' AND `STUD_ID`='$regNo' AND `COURSE_NAME`='$courseReq'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));



    $TABLE_NAME = 'USERS_TABLE';
    
    $sql = "DELETE FROM `$TABLE_NAME` WHERE `USER_ID`='$regNo'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));



    $TABLE_NAME = 'FACULTY_'.$username;
    
    $sql = "DELETE FROM `$TABLE_NAME` WHERE `STUD_ID`='$regNo' AND `COURSE_NAME`='$courseReq'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));



    $TABLE_NAME = 'STD_DB_'.$regNo;
    
    $sql = "DROP TABLE $TABLE_NAME";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));


      $sql = "DELETE FROM `USERS_REQ_TABLE` WHERE `USER_ID`='$regNo'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: $sql".mysqli_error($link));

$sql = "DELETE FROM `FREQUENCY_TABLE` WHERE `REG_ID`='$regNo'";

$db = mysqli_query($link,$sql);

if(!$db)
    die("Failed to Insert: $sql".mysqli_error($link));


echo "1";
      return;
?>