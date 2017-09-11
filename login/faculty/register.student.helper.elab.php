<?php
    session_start();
    $username =  $_SESSION['uname'];



    include_once(__DIR__."/../../includes/sql.config.php");


    $TABLE_NAME= 'users_req_table';

    $sql= "SELECT * FROM $TABLE_NAME WHERE UNIQUE_ID= '$username'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
        die("Failed to Insert: $sql".mysqli_error($link));

 

    echo "<table><thead><tr><th>Registration Number</th><th>Name</th><th>Password</th></td><tbody>";

    if(mysqli_num_rows($db) > 0) {
        while($row = mysqli_fetch_assoc($db)){
            $regNum = $row['USER_ID'];
            $name = $row['FIRST_NAME']." ".$row['LAST_NAME'];
            $password = $row['PASSWORD'];
            if(strlen($password) == 32) {
                $password = "<span class='red-text'>NO PASSWORD SET</span>";
            }
            echo "<tr><td>$regNum</td><td>$name</td><td>$password</td></tr>";
        }
    }

    echo "</tbody></table>";
?>
