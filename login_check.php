<?php
    session_start();    
    include_once(__DIR__."/includes/sql.config.php");

    $TABLE_NAME = 'users_table';
    

    $username = trim(mysqli_real_escape_string($link,$_REQUEST['uname']));
    
    $password = trim(mysqli_real_escape_string($link,md5($_REQUEST['pass'])));

    if(isset($_SESSION['uname'])) {
        session_destroy();
        session_start();
    }

    if(strpos($username," ") !== false) {
        echo "0";
        return;
    }


    $sql = " SELECT FIRST_NAME,LAST_NAME,ROLE FROM $TABLE_NAME WHERE USER_ID = '$username' AND PASSWORD = '$password'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    if(mysqli_num_rows($db) > 0) {
        if(mysqli_query($link,$sql)) {
            $_SESSION['uname'] = $username;
            $row = mysqli_fetch_assoc($db);
            $fn = $row['FIRST_NAME'];
            $ln = $row['LAST_NAME'];
            $_SESSION['name'] = "$fn $ln";
            $_SESSION['role'] = $row['ROLE'];
            echo $row['ROLE'];
        }
          
    } else {
        echo 0;
    }
?>
