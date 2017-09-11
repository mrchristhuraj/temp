<?php
    session_start();
    $final_result = Array();
    $final_result['error'] = 0;
    
    include_once(__DIR__."/../../../includes/sql.config.php");

        $final_result['error'] = 0;


    $username = $_SESSION['uname'];

    $finals_results = Array();
  

    $password = $_REQUEST['password'];
    $password_retype = $_REQUEST['password_retype'];
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


    $password = md5($password);

    $sql = "UPDATE `users_table` SET `MAIL_ID`='$email',`MOBILE`=$mobile,`PASSWORD`='$password',`DOB`='$dob' WHERE `USER_ID` LIKE '$username'";

  

    $db = mysqli_query($link,$sql);

    if(!$db) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "INTERNAL ERROR...Contant Update... CONTACT ADMIN";
    }


    echo json_encode($final_result);
?>
