<?php
    session_start();
    $username = $_SESSION['uname'];
    $course_id = $_REQUEST['course_id'];
    $TABLE_NAME = "FACULTY_".$username;


    $action = $_REQUEST['action'];
    
   
    include_once(__DIR__."/../../includes/sql.config.php");
    $final_result['error'] = 0;

    //$sql = "SELECT SUM(`LEVEL_1`) AS NOS1, SUM(`LEVEL_2`) AS NOS2, SUM(`LEVEL_3`)AS NOS3, COUNT(*) AS NOS FROM `$TABLE_NAME`WHERE `COURSE_ID` = $course_id";
    $sql = "SELECT (SELECT COUNT(*) FROM `$TABLE_NAME`WHERE `COURSE_ID` = $course_id) AS NOS,(SELECT COUNT(*) FROM `$TABLE_NAME`WHERE `COURSE_ID` = $course_id AND `LEVEL_1` = 100)AS NOS1,(SELECT COUNT(*) FROM `$TABLE_NAME`WHERE `COURSE_ID` = $course_id AND `LEVEL_2` = 100)AS NOS2,(SELECT COUNT(*) FROM `$TABLE_NAME`WHERE `COURSE_ID` = $course_id AND `LEVEL_3` = 100)AS NOS3";


    $db = mysqli_query($link,$sql);
    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = mysqli_error($db);
        echo json_encode($final_result);
        return;
    } 

    $row = mysqli_fetch_assoc($db);

    if($row['NOS'] == 0) {
        $final_result['L1'] = "0/0"; 
        $final_result['L2'] = "0/0"; 
        $final_result['L3'] = "0/0"; 
    }else {
        $final_result['L1'] = $row['NOS1']."/".$row['NOS'];
        $final_result['L2'] = $row['NOS2']."/".$row['NOS'];
        $final_result['L3'] = $row['NOS3']."/".$row['NOS']; 
    }


    echo json_encode($final_result);

          

?>