<?php
    session_start();
    $username = $_SESSION['uname'];
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];
    $TABLE_NAME = "SESSION_TABLE";

    
    $action = $_REQUEST['action'];
    $final_result = Array();
    $final_result['error'] = 0;
    
    
    
    include_once(__DIR__."/../../includes/sql.config.php");
    $final_result['error'] = 0;

    if($action == "POST") {
          //ACCEPT FIELD
      $session_name = $_REQUEST['session_names'];
      $i = 0;
      for($i=11;$i < 21; $i++) {
            $course_id_new = $course_id."".$i;
            $session_name_new = $session_name[$i];
            $sql = "REPLACE into $TABLE_NAME (`COURSE_SESSION_ID`,`SESSION_NAME`) values($course_id_new,'$session_name_new')";
            $db = mysqli_query($link,$sql);
            if(!$db) {
                  $final_result['error'] = 1;   
                  $final_result['error_msg'] = "FAILED TO INSERT SESSIONS".$sql;
            }
      }
    }elseif($action == "GET") {
          $like = $course_id."__";
          $sql = "SELECT * FROM `session_table` WHERE CAST(`COURSE_SESSION_ID` as CHAR) LIKE '$like' ORDER BY COURSE_SESSION_ID ASC";
          $db = mysqli_query($link,$sql);
            if(!$db) {
                  $final_result['error'] = 1;   
                  $final_result['error_msg'] = "FAILED TO INSERT SESSIONS";
            }
            if(mysqli_num_rows($db) > 0) {
                  $j = 11;
                  while($row = mysqli_fetch_assoc($db)) {
                        $final_result[$j] = $row['SESSION_NAME'];
                        $j++;
                  }
            }
    }
    

    echo json_encode($final_result);
?> 