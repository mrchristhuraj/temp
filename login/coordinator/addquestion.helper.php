<?php
    session_start();
    $username = $_SESSION['uname'];
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];
    $TABLE_NAME = $course_name."_QUESTION_TABLE";
    

    $action = $_REQUEST['action'];
    $final_result = Array();

   
    
    include_once(__DIR__."/../../includes/sql.config.php");
    $final_result['error'] = 0;

    if($action == "POST") {
          $question_name = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['question_name']));
          $session_name = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['session_name']));
          $session_id = $_REQUEST['session_id'];
          $level_id = $_REQUEST['level_id'];
          $question_desc = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['question_desc']));
          $test_case_1_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_1_input']));
          $test_case_2_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_2_input']));
          $test_case_3_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_3_input']));
          $test_case_4_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_4_input']));
          $test_case_5_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_5_input']));
          $test_case_1_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_1_output']));
          $test_case_2_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_2_output']));
          $test_case_3_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_3_output']));
          $test_case_4_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_4_output']));
          $test_case_5_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_5_output']));

            $tc1 = addslashes($test_case_1_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_1_output); 
            $tc2 = addslashes($test_case_2_input."\n"."###---###SEPERATOR---###---"."\n".$test_case_2_output); 
            $tc3 = addslashes($test_case_3_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_3_output); 
            $tc4 = addslashes($test_case_4_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_4_output); 
            $tc5 = addslashes($test_case_5_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_5_output); 

            if($test_case_1_input == "0" && $test_case_1_output = "0") {
                  $tc1 = 0;
            }
            if($test_case_2_input == "0" && $test_case_2_output = "0") {
                  $tc2 = 0;
            }
            if($test_case_3_input == "0" && $test_case_3_output = "0") {
                  $tc3 = 0;
            }
            if($test_case_4_input == "0" && $test_case_4_output = "0") {
                  $tc4 = 0;
            }
            if($test_case_5_input == "0" && $test_case_5_output = "0") {
                  $tc5 = 0;
            }


          $q_id_template = $session_id.$level_id."_____";

          $sql_get_q_id = "SELECT Q_ID,S_NAME FROM `$TABLE_NAME` WHERE CAST(Q_ID as CHAR) LIKE '$q_id_template' ORDER BY Q_ID DESC LIMIT 1";
          
          $db_get_q_id = mysqli_query($link,$sql_get_q_id);
            if(!$db_get_q_id) {
                  $final_result['error'] = 1;   
                  $final_result['error_msg'] = "FAILED TO GET Question ID";
            }

            if(mysqli_num_rows($db_get_q_id) > 0) {
                  //add at last
                  while($row = mysqli_fetch_assoc($db_get_q_id)) {
                        $q_id_new = intval($row['Q_ID']) + 1;
                        $final_result['old q_id'] = $q_id_new;
                        $table_name_new = $course_name."_QUESTION_TABLE";
                        $sql_add = "INSERT INTO `$table_name_new` (`Q_ID`, `S_NAME`, `Q_NAME`, `Q_DESC`, `TESTCASE_1`, `TESTCASE_2`, `TESTCASE_3`, `TESTCASE_4`, `TESTCASE_5`) VALUES ($q_id_new,'$session_name','$question_name','$question_desc','$tc1','$tc2','$tc3','$tc4','$tc5')";

                        $db_add = mysqli_query($link,$sql_add);
                        if(!$db_add) {
                              $final_result['error'] = 1;   
                              $final_result['error_msg'] = "FAILED TO ADD Question ID".mysqli_error($link);
                        }
                  }
            }else {
                  //newlyadd
                  $q_id_template = $session_id.$level_id."10001";
                   $table_name_new = $course_name."_QUESTION_TABLE";
                  $sql_add = "INSERT INTO `$table_name_new` (`Q_ID`, `S_NAME`, `Q_NAME`, `Q_DESC`, `TESTCASE_1`, `TESTCASE_2`, `TESTCASE_3`, `TESTCASE_4`, `TESTCASE_5`) VALUES ($q_id_template,'$session_name','$question_name','$question_desc','$tc1','$tc2','$tc3','$tc4','$tc5')";
                  $db_add = mysqli_query($link,$sql_add);
                  if(!$db_add) {
                        $final_result['error'] = 1;   
                        $final_result['error_msg'] = "FAILED TO ADD NEW Question ID".mysqli_error($link);
                  }
            }
      }elseif($action == "GET") {
            $table_name_new = $course_name."_QUESTION_TABLE";
          $q_id = $_REQUEST['q_id'];
          $sql_check = "SELECT * FROM `$table_name_new` WHERE Q_ID = $q_id";
          $db_check = mysqli_query($link,$sql_check);
            if(!$db_check) {
                  $final_result['error'] = 1;   
                  $final_result['error_msg'] = "FAILED TO GET Question Table".mysqli_error($link);
            }

            if(mysqli_num_rows($db_check) > 0) {
                  while($row = mysqli_fetch_assoc($db_check)){
                        $final_result['debug'] = $row['TESTCASE_1'];
                        $final_result['s_name'] = $row['S_NAME'];
                        $final_result['q_name'] = $row['Q_NAME'];
                        $final_result['q_desc'] = $row['Q_DESC'];

                        if($row['TESTCASE_1'] == "0") {
                              $final_result['tc_1_in'] = 0;
                              $final_result['tc_1_out'] = 0;
                        }else { 
                              $tc = explode('###---###SEPERATOR---###---',$row['TESTCASE_1'],2);
                              $final_result['tc_1_in'] = trim($tc[0]);
                              $final_result['tc_1_out'] = trim($tc[1]);
                        }

                        if($row['TESTCASE_2'] == "0") {
                              $final_result['tc_2_in'] = 0;
                              $final_result['tc_2_out'] = 0;
                        }else { 
                              $tc = explode('###---###SEPERATOR---###---',$row['TESTCASE_2'],2);
                              $final_result['tc_2_in'] = trim($tc[0]);
                              $final_result['tc_2_out'] = trim($tc[1]);
                        }

                        if($row['TESTCASE_3'] == "0") {
                              $final_result['tc_3_in'] = 0;
                              $final_result['tc_3_out'] = 0;
                        }else { 
                              $tc = explode('###---###SEPERATOR---###---',$row['TESTCASE_3'],2);
                              $final_result['tc_3_in'] = trim($tc[0]);
                              $final_result['tc_3_out'] = trim($tc[1]);
                        }

                        if($row['TESTCASE_4'] == "0") {
                              $final_result['tc_4_in'] = 0;
                              $final_result['tc_4_out'] = 0;
                        }else { 
                              $tc = explode('###---###SEPERATOR---###---',$row['TESTCASE_4'],2);
                              $final_result['tc_4_in'] = trim($tc[0]);
                              $final_result['tc_4_out'] = trim($tc[1]);
                        }

                        if($row['TESTCASE_5'] == "0") {
                              $final_result['tc_5_in'] = 0;
                              $final_result['tc_5_out'] = 0;
                        }else { 
                              $tc = explode('###---###SEPERATOR---###---',$row['TESTCASE_5'],2);
                              $final_result['tc_5_in'] = trim($tc[0]);
                              $final_result['tc_5_out'] = trim($tc[1]);
                        }
                  }
            }else {
                  $final_result['error'] = 2;   
                  $final_result['temp'] = $sql_check;
            }
    }elseif($action == "SET") {
            $table_name_new = $course_name."_QUESTION_TABLE";
            $question_id = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['question_id']));
            $question_name = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['question_name']));
          $question_desc = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['question_desc']));
            $test_case_1_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_1_input']));
            $test_case_2_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_2_input']));
            $test_case_3_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_3_input']));
            $test_case_4_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_4_input']));
            $test_case_5_input = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_5_input']));
            $test_case_1_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_1_output']));
            $test_case_2_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_2_output']));
            $test_case_3_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_3_output']));
            $test_case_4_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_4_output']));
            $test_case_5_output = addslashes(iconv('UTF-8','ASCII//IGNORE',$_REQUEST['test_case_5_output']));

            $tc1 = addslashes($test_case_1_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_1_output); 
            $tc2 = addslashes($test_case_2_input."\n"."###---###SEPERATOR---###---"."\n".$test_case_2_output); 
            $tc3 = addslashes($test_case_3_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_3_output); 
            $tc4 = addslashes($test_case_4_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_4_output); 
            $tc5 = addslashes($test_case_5_input."\n".'###---###SEPERATOR---###---'."\n".$test_case_5_output); 
            if($test_case_1_input == "0" && $test_case_1_output = "0") {
                  $tc1 = 0;
            }
            if($test_case_2_input == "0" && $test_case_2_output = "0") {
                  $tc2 = 0;
            }
            if($test_case_3_input == "0" && $test_case_3_output = "0") {
                  $tc3 = 0;
            }
            if($test_case_4_input == "0" && $test_case_4_output = "0") {
                  $tc4 = 0;
            }
            if($test_case_5_input == "0" && $test_case_5_output = "0") {
                  $tc5 = 0;
            }


            $sql_update = "UPDATE `$table_name_new` SET `Q_NAME`='$question_name',`Q_DESC`='$question_desc',`TESTCASE_1`='$tc1',`TESTCASE_2`='$tc2',`TESTCASE_3`='$tc3',`TESTCASE_4`='$tc4',`TESTCASE_5`='$tc5' WHERE `Q_ID` = $question_id";
            $db_update = mysqli_query($link,$sql_update);
            if(!$db_update) {
                  $final_result['error'] = 1;   
                  $final_result['error_msg'] = "FAILED TO UPDATE QUESTION TABLE".mysqli_error($link);
            }

    }
    

    echo json_encode($final_result);
?> 
