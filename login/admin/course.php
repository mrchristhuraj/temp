<?php


    $course_name = $_REQUEST['course_name'];
    $action = $_REQUEST['action'];

    
    include_once(__DIR__."/../../includes/sql.config.php");
    $final_results['error'] = 0;


    if($action == "ADD") {
        $sql_get_data = "SELECT * FROM COURSE_TABLE ORDER BY COURSE_ID DESC LIMIT 1";
        $db_get_data = mysqli_query($link,$sql_get_data);
        if(!$db_get_data) {
            $final_results['error'] = 1;
            $final_results['error_msg'] = "Failed: ".mysqli_error($link);
    echo json_encode($final_results);
            
            exit;
        }

        $course_id = 0;
        if(mysqli_num_rows($db_get_data) > 0) { 
            $row = mysqli_fetch_assoc($db_get_data);
            $course_id = intval($row['COURSE_ID']) + 1;
        }else {
            $course_id = 11;
        }
        $final_results['course_id'] = $course_id;


        //insert into course table
        $sql_course_add = "INSERT INTO `course_table`(`COURSE_ID`, `COURSE_NAME`) VALUES ($course_id,'$course_name');";
        $db_course_add = mysqli_query($link,$sql_course_add);
        if(!$db_course_add) {
            $final_results['error'] = 1;
            $final_results['error_msg'] = "Failed to insert in course table: ".mysqli_error($link);
    echo json_encode($final_results);
            
            exit;
        }

        //make a question table
        $table_name_question = $course_name."_question_table";
        $sql_question = "CREATE TABLE `$table_name_question` (
            Q_ID bigint(12),
            S_NAME varchar(50),
            Q_NAME varchar(1000),
            Q_DESC text,
            TESTCASE_1 longtext,
            TESTCASE_2 longtext,
            TESTCASE_3 longtext,
            TESTCASE_4 longtext,
            TESTCASE_5 longtext,
            PRIMARY KEY (Q_ID)
            )";
        $db_question = mysqli_query($link,$sql_question);
        if(!$db_question) {
            $final_results['error'] = 1;
            $final_results['error_msg'] = "Failed to make question table: ".mysqli_error($link);
    echo json_encode($final_results);
            
            exit;
        }

        //make a coordinator table, generate username and password
        $final_results['username'] = "coordinator_".strtolower($course_name);
        $coordinator_uname = $final_results['username'];
        $final_results['password'] = bin2hex(openssl_random_pseudo_bytes(4));
        $coordinator_password = md5($final_results['password']);
        

        $table_name_coordinator = "coordinator_".$course_id;
        $sql_coordinator = "CREATE TABLE `$table_name_coordinator` (
            FACULTY_NAME varchar(50),
            FACULTY_ID varchar(50),
            COURSE_ID int(11) DEFAULT $course_id,
            PRIMARY KEY (FACULTY_ID)
            )";
        $db_coordinator = mysqli_query($link,$sql_coordinator);
        if(!$db_coordinator) {
            $final_results['error'] = 1;
            $final_results['error_msg'] = "Failed to make coordinator table: ".mysqli_error($link);
            echo json_encode($final_results);
            exit;
        }

        $sql_add_coordinator = "INSERT INTO `users_table`(`USER_ID`, `ROLE`, `PASSWORD`) VALUES ('$coordinator_uname','C','$coordinator_password')";
        $db_add_coordinator = mysqli_query($link,$sql_add_coordinator);
        if(!$db_add_coordinator) {
            $final_results['error'] = 1;
            $final_results['error_msg'] = "Failed to add coordinator table: ".mysqli_error($link);
            echo json_encode($final_results);
            exit;
        }

    }elseif($action == "DELETE") {

    }


    echo json_encode($final_results);
?>