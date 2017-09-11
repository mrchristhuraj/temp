<?php
    session_start();
    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $course_name = $_SESSION['course_name'];
    $faculty_id = $_REQUEST['id'];
    $faculty_data = $_REQUEST['rowData'];
    $course_id = $_SESSION['course_id'];
    $TABLE_NAME = "faculty_".$faculty_id."";
    
    
    include_once(__DIR__."/../../includes/sql.config.php");
    
    $sql = "SELECT * FROM $TABLE_NAME WHERE COURSE_ID = $course_id";
    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    echo "
                        <h5 class=\"title\">$faculty_data</h5><table id=\"table_display_data\"  class=\"bordered centered highlight\">
                    <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th> 
                        <th>Course Name</th> 
                        <th>LEVEL 1</th>
                        <th>LEVEL 2</th>
                        <th>LEVEL 3</th>
                    </tr> 
                    </thead><tbody>";
    if(mysqli_num_rows($db) > 0) {
        if(mysqli_query($link,$sql)) {
            while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>".$row['STUD_ID']."</td>";
                echo "<td>".$row['STUD_NAME']."</td>";
                echo "<td>".$row['COURSE_NAME']."</td>";
                echo "<td>".$row['LEVEL_1']."%</td>";
                echo "<td>".$row['LEVEL_2']."%</td>";
                echo "<td>".$row['LEVEL_3']."%</td>";
                echo "</tr>";
            }
        }
    }
    echo "</tbody><table>";

?> 