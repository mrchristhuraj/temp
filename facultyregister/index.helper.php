<?php
    
    include_once(__DIR__."/../includes/sql.config.php");
    include_once(__DIR__."/../includes/node.config.php");

        $sql = "SELECT * FROM `flags`";
      $db = mysqli_query($link,$sql);
      if(!$db)
            die("Failed to Insert: ".mysqli_error($link));
      $row = null;
      if(mysqli_num_rows($db) > 0 ){
        while ($row = mysqli_fetch_assoc($db)) {
            if($row['NAME'] == 'FACULTY_REGISTER') {
              if($row['VALUE'] == 0) {
                  $finals_result['error'] = 1;
                  $final_result['errorMsg'] = "Registartion is Closed";
                  exit;
              }
            }
          }
     }

    $final_result['error'] = 0;

     $username = $_REQUEST['username'];
    if($username == null || (strlen($username) < 6)) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INVALID USERNAME";
        echo json_encode($final_result);
        return;
    }

    
    $username = trim($_REQUEST['username']);
    if($username == null || (strlen($username) < 6)) {
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




    $sql_check = "SELECT * FROM USERS_TABLE WHERE USER_ID = '$username'";
    $db_check = mysqli_query($link,$sql_check);
    if(!$db_check) 
          die("Failed to Insert HERE: ".mysqli_error($link));

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
    if (!isset($password_retype)) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Retype Password Not Provided";
        echo json_encode($final_result);
        return;
    }
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


$sql = "CREATE TABLE IF NOT EXISTS `faculty_$username` (
  `STUD_ID` varchar(20),
  `STUD_NAME` varchar(50),
  `COURSE_NAME` varchar(20),
  `COURSE_ID` int(11),
 `LEVEL_1` int(11),
`LEVEL_2` int(11),
`LEVEL_3` int(11),
`REQ_ID` varchar(25),
  PRIMARY KEY (`REQ_ID`)
) ;";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN";
    }






    $TABLE_NAME = "USERS_TABLE";

    //$unique_id = md5(bin2hex(openssl_random_pseudo_bytes(4)));

    $password = md5($password);
    $sql = "INSERT INTO $TABLE_NAME (`USER_ID`,`FIRST_NAME`,`LAST_NAME`,`MAIL_ID`,`MOBILE`,`ROLE`,`PASSWORD`,`DOB`,`DEPT`) VALUES (
        '$username','$first_name','$last_name','$email','$mobile','F','$password','$dob','$dept_name'
        
    )";

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR... CONTACT ADMIN";
    }


    echo json_encode($final_result);
?>
