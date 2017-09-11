<?php
session_start();
if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'F') {
        echo "ERROR IN SESSION"; 
        exit;
    }
    $staffID = $_SESSION['uname'];
    $name = $_SESSION['name'];
    

    $course_id = $_REQUEST['course_id'];

    
    include_once(__DIR__."/../../includes/sql.config.php");

    $TABLE_NAME = "faculty_".$staffID;
    $sql = "SELECT * FROM $TABLE_NAME WHERE COURSE_NAME = '$course_id'";


?>


<?php
    
    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    echo "
                        <table id=\"table_display_data\"  class=\"bordered centered highlight\">
                    <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th> 
                        <th>Course Name</th> 
                        <th>Completed</th>
                    </tr> 
                    </thead><tbody>";
    if(mysqli_num_rows($db) > 0) {
        if(mysqli_query($link,$sql)) {
            while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>".$row['STUD_ID']."</td>";
                echo "<td>".$row['STUD_NAME']."</td>";
                echo "<td>".$row['COURSE_NAME']."</td>";
                echo "<td>".($row['LEVEL_1']*10)."%</td>";
                echo "</tr>";
            }
        }
    }
    echo "</tbody><table>";

?> 