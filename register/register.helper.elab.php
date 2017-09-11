<?php
    $final_result = Array();
    $final_result['error'] = 0;
    
    include_once(__DIR__."/../includes/sql.config.php");

    $sql = "SELECT * FROM `flags`";
      $db = mysqli_query($link,$sql);
      if(!$db)
            die("Failed to Insert: ".mysqli_error($link));
      $row = null;
      if(mysqli_num_rows($db) > 0 ){
        while ($row = mysqli_fetch_assoc($db)) {
            if($row['NAME'] == 'STUDENT_REGISTER') {
              if($row['VALUE'] == 0) {
                  $finals_result['error'] = 1;
                  $final_result['errorMsg'] = "Registartion is Closed";
                  exit;
              }
            }
          }
     }

    $final_result['error'] = 0;
   
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
          die("Failed to Insert: ".mysqli_error($link));

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

    $password = trim($_REQUEST['password']);
    $password_retype = trim($_REQUEST['password_retype']);
    if ($password == null || strlen($password) < 8) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Password should be of aleast 8 characters";
        echo json_encode($final_result);
        return;
    }

    if ($password != $password_retype) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Password Mismatch";
        echo json_encode($final_result);
        return;
    }

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
    $email = $_REQUEST['email'];
    if ($email == null || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Invalid Email ID";
        echo json_encode($final_result);
        return;
    }


    $dob = $_REQUEST['dob'];
    if ($dob == null) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Invalid Date of Birth";
        echo json_encode($final_result);
        return;
    }

    $mobile = $_REQUEST['mobile'];
    if ($mobile == null || strlen($mobile) != 10) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Invalid Mobile Number";
        echo json_encode($final_result);
        return;
    }


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
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN";
    }

    $sql = "INSERT INTO `users_table`(
        `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAIL_ID`, `MOBILE`, `ROLE`, `PASSWORD`, `DOB`, `DEPT`)
         VALUES
         ('$username','$first_name','$last_name','$email','$mobile','S','$password','$dob','$dept_name')";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN";
    }                        


    echo json_encode($final_result);
?>