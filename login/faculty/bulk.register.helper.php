<?php
session_start();
if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'F') {
    echo "ERROR IN SESSION";
    exit;
}



include_once(__DIR__."/../../includes/general.config.php");
include_once(__DIR__."/../../includes/sql.config.php");


$facultyName =  $_SESSION['uname'];


$tmpfile = $_FILES['file']['tmp_name'];

if(($handle = fopen($tmpfile, 'r')) !== false) {

    set_time_limit(0);
    $row = 0;
    while(($data = fgetcsv($handle, 1000, ',')) !== false) {
        if($row == 0) {
            $row++;
            continue;
        }
        $col_count = count($data);

        if($data[0] != '') {
            $regNo = $data[0];
            $first_name = $data[1];
            $last_name = $data[2];
            $dept_name = $data[3];

            $username = trim($regNo);
            if($username == null || $username == "" || strlen($username) < 6) {
                echo "<p class='red white-text'>$regNo -> Invalid Reg. No</p>";
                continue;
            }

            if(strpos($username," ") !== false) {
                echo "<p class='red white-text'>$regNo -> White Spaces Not Allowed in Reg. No</p>";
                continue;
            }

            $sql_check = "SELECT * FROM USERS_TABLE WHERE USER_ID = '$username'";
            $db_check = mysqli_query($link,$sql_check);
            if(!$db_check)
                die("Failed to Get User: ".mysqli_error($link));

            if(mysqli_num_rows($db_check) > 0) {
                echo "<p class='red white-text'>$regNo -> User Already Exist</p>";
                continue;
            }

            if($dept_name == null || $dept_name == "") {
                echo "<p class='red white-text'>$regNo -> Enter a Valid Department Name</p>";
                continue;
            }

            $password = md5($facultyName."password");

            if ($first_name == null || $first_name == ""|| !preg_match("/^[a-zA-Z]*$/",$first_name)) {
                echo "<p class='red white-text'>$regNo -> First Name can have only letters</p>";
                continue;
            }

            if ($last_name == null || $last_name == "" || !preg_match("/^[a-zA-Z]*$/",$last_name)) {
                echo "<p class='red white-text'>$regNo -> Last Name can have only letters</p>";
                continue;
            }

            $email = "student@srm.com";

            $dob = "2017-03-21";

            $mobile = "1234567890";

            $TABLE_NAME = "USERS_REQ_TABLE";

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
                echo "<p class='red white-text'>$regNo -> Can't Create Students Table</p>";
                continue;
            }

            $sql = "INSERT INTO `users_table`(
            `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAIL_ID`, `MOBILE`, `ROLE`, `PASSWORD`, `DOB`, `DEPT`)
             VALUES
             ('$username','$first_name','$last_name','$email','$mobile','S','$password','$dob','$dept_name')";

            $db = mysqli_query($link,$sql);

            if(!$db) {
                echo "<p class='red white-text'>$regNo -> Can't Create User</p>";
                continue;
            }

            $sql = "INSERT INTO `users_req_table`(
            `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAIL_ID`, `MOBILE`, `ROLE`, `PASSWORD`, `DOB`, `DEPT`,`UNIQUE_ID`)
             VALUES
             ('$username','$first_name','$last_name','$email','$mobile','S','$password','$dob','$dept_name','$facultyName')";

            $db = mysqli_query($link,$sql);

            if(!$db) {
                echo "<p class='red white-text'>$regNo -> Can't Assign Student To Faculty</p>";
                continue;
            }


            echo "<p class='green white-text'>$regNo -> Student Successfully Created</p>";
        }
    }
    fclose($handle);
}else {
    $fileData = json_encode($_FILES);
    echo "<p class='red'>Error in Opening File: $fileData</p>";
}


?>