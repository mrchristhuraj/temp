<?php
    session_start();
    
    include_once(__DIR__."/../../includes/sql.config.php");

    if($_REQUEST['mode'] == "countStudent") {
        $course_id =  $_REQUEST['courseid'];

        $sql = "SELECT COUNT(*) AS NOS FROM COURSE_REG_TABLE WHERE COURSE_ID = $course_id";
        $db = mysqli_query($link,$sql);
        if(!$db) 
            die("Failed to Insert: ".mysqli_error($link));
        $row = mysqli_fetch_assoc($db);
        echo $row['NOS'];   
    }else if($_REQUEST['mode'] == "facultyList") {
        $course_id =  $_REQUEST['courseid'];
        $TABLE_NAME = "COORDINATOR_".$course_id;
        echo "<option value=\"\" disabled selected>Choose Faculty</option>";
        $sql_regid = "SELECT FACULTY_ID,FACULTY_NAME FROM $TABLE_NAME";
        $db_regid = mysqli_query($link,$sql_regid);
        if(!$db_regid) 
            die("Failed to Insert: ".mysqli_error($link));
        if(mysqli_num_rows($db_regid) > 0) {
            if(mysqli_query($link,$sql_regid)) {
                while($row = mysqli_fetch_assoc($db_regid)){
                    $temp1 = $row['FACULTY_ID'];
                    $temp2 = $row['FACULTY_NAME'];
                    echo "<option value=\"".$row['FACULTY_ID']."\">".$temp1." - ".$temp2."</option>";
                }
            }
        }
    }else if($_REQUEST['mode'] == "facultyCount") {
        $course_id =  $_REQUEST['courseid'];
        $faculty_id =  $_REQUEST['facultyid'];

        $sql = "SELECT COUNT(*) AS NOS FROM COURSE_REG_TABLE WHERE COURSE_ID = $course_id AND STAFF_ID = '$faculty_id'";
        $db = mysqli_query($link,$sql);
        if(!$db) 
            die("Failed to Insert: ".mysqli_error($link));
        $row = mysqli_fetch_assoc($db);
        echo $row['NOS'];   
    }

    /* $sql = "SELECT * FROM $TABLE_NAME";
    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    echo "<table class=\"bordered centered highlight\">
                    <thead>
                    <tr>
                        <th>Course ID</th> 
                        <th>Course Name</th> 
                    </tr> 
                    </thead><tbody>";
    if(mysqli_num_rows($db) > 0) {
        if(mysqli_query($link,$sql)) {
            while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>".$row['COURSE_ID']."</td>";
                echo "<td>".$row['COURSE_NAME']."</td>";
                echo "</tr>";
            }
        }
    }
    echo "</tbody><table>"; */

?>