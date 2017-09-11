<?php
    session_start();
    
    include_once(__DIR__."/../../includes/sql.config.php");

    $username = $_REQUEST['uname'];
    $course_id = $_REQUEST['course_id'];
    $type = $_REQUEST['q'];
    
    $TABLE_NAME = "STD_DB_".$username;

    if($type == "SESSION") {
        $sql0 = "SELECT * FROM COURSE_TABLE WHERE COURSE_ID = $course_id";
        $db0 = mysqli_query($link,$sql0);
        if(!$db0) 
              die("Failed to Insert: ".mysqli_error($link));
        if(mysqli_num_rows($db0) > 0) {
            while($row = mysqli_fetch_assoc($db0)) {
                $course_id = $row['COURSE_ID'];
                $_SESSION['course_id'] = $course_id;
            }
        }

        $course_id = "".$course_id."__";
        $sql = "SELECT SESSION_NAME FROM SESSION_TABLE WHERE CAST(COURSE_SESSION_ID as CHAR) LIKE '$course_id' ORDER BY COURSE_SESSION_ID";
        
        $db = mysqli_query($link,$sql);
        if(!$db) 
              die("Failed to Insert: ".mysqli_error($link));
        $names = Array();
        $names['course_name'] = $course_name;
        if(mysqli_num_rows($db) > 0) {
            if(mysqli_query($link,$sql)) {
                $i = 0;
                while($row = mysqli_fetch_assoc($db)){
                    $names[$i] = $row['SESSION_NAME'];
                    $i++;
                }
            }
        }
        echo json_encode($names);
        
    } elseif($type == "VALUES") {
        $course_id = $_REQUEST['course_id'];
        
        $status = Array();
        $status['id'] = $course_id;

        $course_id = "".$course_id."__"."_"."__";

            $sql2 = "SELECT SEQUENCE_ID, STATUS FROM $TABLE_NAME WHERE CAST(SEQUENCE_ID as CHAR) LIKE '$course_id' ORDER BY SEQUENCE_ID";
            
            $db2 = mysqli_query($link,$sql2);
            if(!$db2) 
                die("Failed to Insert: ".mysqli_error($link));

            if(mysqli_num_rows($db2) > 0) {
                $status['completed'] = 0;
                    while($row = mysqli_fetch_assoc($db2)){
                        $sid = "".$row['SEQUENCE_ID'];
                        $status[$sid] = $row['STATUS'];
                    }
            }
        
        echo json_encode($status);
    } else {
        echo "ERROR (0X1)";
    }
?>