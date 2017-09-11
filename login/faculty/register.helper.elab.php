<?php
    
        session_start();
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");

    $final_result = Array();
    
    $final_result['error'] = 0;
     $facultyName =  $_SESSION['uname'];
   
    $username = trim($_REQUEST['username']);
    if($username == null || strlen($username) < 6) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INVALID USERNAME";
        echo json_encode($final_result);
        return;
    }

    if(strpos($username," ") !== false) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "WHITESPACES ARE NOT ALLOWED";
        echo json_encode($final_result);
        return;
    }


    $finals_results = Array();

    $sql_check = "SELECT * FROM USERS_TABLE WHERE USER_ID = '$username'";
    $db_check = mysqli_query($link,$sql_check);
    if(!$db_check) 
          die("Failed to Get User: ".mysqli_error($link));

    if(mysqli_num_rows($db_check) > 0) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "USER ALREADY EXIST";
        echo json_encode($final_result);
        return;
    }

    $dept_id = $_REQUEST['dept_id'];
    if($dept_id == null) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Please Select a Department";
        echo json_encode($final_result);
        return;
    }
    $dept_name = $_REQUEST['dept_name'];

    $password = trim(md5($facultyName."password"));




    $first_name = $_REQUEST['first_name'];
    if ($first_name == null || !preg_match("/^[a-zA-Z]*$/",$first_name)) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "First Name can have only letters";
        echo json_encode($final_result);
        return;
    }

    $last_name = $_REQUEST['last_name'];
    if ($last_name == null || !preg_match("/^[a-zA-Z]*$/",$last_name)) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Last Name can have only letters";
        echo json_encode($final_result);
        return;
    }
    $email = "student@srm.com";

    $dob = "2017-03-21";

    $mobile = "1234567890";


    $TABLE_NAME = "USERS_REQ_TABLE";

    $unique_id = md5(bin2hex(openssl_random_pseudo_bytes(4)));


    $password = md5($password);
    
    $sql = "CREATE TABLE IF NOT EXISTS `std_db_$username` (
  `STAFF_ID` varchar(15) DEFAULT NULL,
  `SEQUENCE_ID` int(11) NOT NULL DEFAULT '0',
  `Q_ID` bigint(20) NOT NULL,
  `S_NAME` varchar(50) DEFAULT NULL,
  `Q_NAME` varchar(100) DEFAULT NULL,
  `Q_DESC` text,
  `TESTCASE_1` text,
  `TESTCASE_2` text,
  `TESTCASE_3` text,
  `TESTCASE_4` text,
  `TEXTCASE_5` text,
  `STATUS` int(11) DEFAULT NULL,
  `CODE` longtext,
  `IO` longtext,
  `OTHER_INFO` longtext,
  `DATE_STARTED` datetime DEFAULT NULL,
  `DATE_ENDED` datetime DEFAULT NULL,
  `FILES` blob,
  PRIMARY KEY (`Q_ID`)
) ;";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN1";
    }

    $sql = "INSERT INTO `users_table`(
        `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAIL_ID`, `MOBILE`, `ROLE`, `PASSWORD`, `DOB`, `DEPT`)
         VALUES
         ('$username','$first_name','$last_name','$email','$mobile','S','$password','$dob','$dept_name')";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN2";
    }                        


      $sql = "INSERT INTO `users_req_table`(
        `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAIL_ID`, `MOBILE`, `ROLE`, `PASSWORD`, `DOB`, `DEPT`,`UNIQUE_ID`)
         VALUES
         ('$username','$first_name','$last_name','$email','$mobile','S','$password','$dob','$dept_name','$facultyName')";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN3";
    }         

    echo json_encode($final_result);
?>
