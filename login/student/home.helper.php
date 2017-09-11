<?php session_start();
$_SESSION['course_name'] = $_REQUEST['text'];
echo $_SESSION['course_name'];
?>