<?php
    session_start();
    $username = $_SESSION['uname'];

    
    $regNo = $_REQUEST['rnum'];
    $studName = $_REQUEST['studName'];
    
    $courseReq = $_REQUEST['creq'];
    $TABLE_NAME2 = "STD_DB_$regNo";
    $TABLE_NAME = "".$courseReq."_QUESTION_TABLE";

    

    $data_base = mysqli_select_db($link,DB_NAME);
    $sequence_id = 0;

    include_once(__DIR__."/../../includes/sql.config.php");



     $i = 0;
     $j = 0;
     $k = 0;


$sql0 = "SELECT * FROM `course_table` WHERE COURSE_NAME LIKE '$courseReq'";

                $db0 = mysqli_query($link,$sql0);

            if(!$db0) 
              die("Failed to get course id ".mysqli_error($link)); 


          if(mysqli_num_rows($db0) == 0) {
              die("INCORRECT ENTRY");
          }

          $row = mysqli_fetch_assoc($db0);
          $courseIDReq = intval($row['COURSE_ID']);
          

     $FLAG_NAME = $courseIDReq."_MAX_LVL";
$sql0 = "SELECT * FROM `FLAGS` WHERE NAME LIKE '$FLAG_NAME'";

                $db0 = mysqli_query($link,$sql0);

            if(!$db0) 
              die("Failed to get max level".mysqli_error($link)); 

          $row = mysqli_fetch_assoc($db0);
          $maxLevel = intval($row['VALUE']);


//i is for level
          //j is for session
    for($i=1;$i<2;$i++) {
        for($j=11;$j<12;$j++) {
            $param1 = ($courseIDReq)."__"."1"."_____";
            $param2 = ($courseIDReq)."__"."2"."_____";
            $param3 = ($courseIDReq)."__"."3"."_____";


            if($maxLevel == 3) {
              $sql = "SELECT * FROM `".$courseReq."_question_table` ORDER BY rand( ) LIMIT 10 ";
            }else if($maxLevel == 2) {
              $sql = "SELECT * FROM `".$courseReq."_question_table` WHERE `Q_ID` NOT LIKE '$param3' ORDER BY rand( ) LIMIT 10 ";
            }else {
              $sql = "SELECT * FROM `".$courseReq."_question_table` WHERE `Q_ID` LIKE '$param1' ORDER BY rand( ) LIMIT 10 ";
            }

            $db = mysqli_query($link,$sql);

            if(!$db) 
              die("Failed to Insert: ".mysqli_error($link));  

            $tempJ = 11;
            
            if(mysqli_num_rows($db) > 0) {
                $k = 11;
                  foreach ($db as $row) { 
                    $sequence_id = ($courseIDReq*100000)+($tempJ*1000) + ($i*100) + $k;
                      $qid = mysqli_real_escape_string($link,$row['Q_ID']);
                    $sname = mysqli_real_escape_string($link,$row['S_NAME']);
                    $qname = mysqli_real_escape_string($link,$row['Q_NAME']);
                    $qdesc = mysqli_real_escape_string($link,$row['Q_DESC']);
                    $tc1 = mysqli_real_escape_string($link,$row['TESTCASE_1']);
                     $tc2 = mysqli_real_escape_string($link,$row['TESTCASE_2']);
                     $tc3 = mysqli_real_escape_string($link,$row['TESTCASE_3']);
                     $tc4 = mysqli_real_escape_string($link,$row['TESTCASE_4']);
                     $tc5 = mysqli_real_escape_string($link,$row['TESTCASE_5']);
 
                      $tempJ++;
                    
                    $sql2 = "INSERT INTO `elab_db`.`$TABLE_NAME2` (`STAFF_ID` ,`SEQUENCE_ID` ,`Q_ID` ,`S_NAME` ,`Q_NAME` ,`Q_DESC` ,`TESTCASE_1` ,`TESTCASE_2` ,`TESTCASE_3` ,`TESTCASE_4` ,`TEXTCASE_5` ,`STATUS` ,`CODE` ,`IO` ,`OTHER_INFO` ,`DATE_STARTED` ,`DATE_ENDED` ,`FILES`)
                    VALUES ('$username' , $sequence_id , $qid, '$sname' , '$qname' , '$qdesc' , '$tc1' , '$tc2' , '$tc3' , '$tc4' , '$tc5' , 0 , NULL , NULL , NULL , NULL , NULL , NULL);";
            
                      
                 $db2 = mysqli_query($link,$sql2);

            if(!$db2) 
              die("Failed to Insert: ".mysqli_error($link));  
                  }
                
            }
        }
    }


                $sql3 = "UPDATE `elab_db`.`course_reg_table` SET `STATUS` = 1 WHERE STAFF_ID='$username' AND STUD_ID='$regNo';";

                $db3 = mysqli_query($link,$sql3);

            if(!$db3) 
              die("Failed to Insert: ".mysqli_error($link)); 

              $comdined_value = "".$regNo."".$courseIDReq;
              $sql4 = "INSERT INTO `elab_db`.`FACULTY_$username` (`STUD_ID`, `STUD_NAME`, `COURSE_NAME`, `COURSE_ID`, `LEVEL_1`, `LEVEL_2`, `LEVEL_3`,`REQ_ID`) 
                        VALUES ('$regNo','$studName','$courseReq',$courseIDReq,0,0,0,'$comdined_value')";

            $db4 = mysqli_query($link,$sql4);

            if(!$db4) 
              die("Failed to Insert: ".mysqli_error($link)); 
                
    
    echo 1;


?>
