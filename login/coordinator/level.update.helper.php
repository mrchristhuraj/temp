<?php
	session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'C') {
        echo "ERROR IN SESSION";
        exit;
    }

    $level = $_POST['level'];

     $FLAG_NAME = $_SESSION['course_id']."_MAX_LVL";

    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");

    $sql = "UPDATE `flags` SET `VALUE`=$level WHERE  `NAME`= '$FLAG_NAME' ";

   $db = mysqli_query($link,$sql);
    if(!$db)
          die("Failed to Insert: ".mysqli_error($link));

      echo json_encode(['error' => 0]);

?>