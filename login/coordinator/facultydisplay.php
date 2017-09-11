<?php
    session_start();
    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];
    $TABLE_NAME = "coordinator_".$course_id."";
    
    
    include_once(__DIR__."/../../includes/sql.config.php");
      $sql = "SELECT * FROM $TABLE_NAME";
    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    echo "<table id=\"table_display_data\" class=\"bordered centered highlight\">
                    <thead>
                    <tr>
                        <th>Faculty Name</th>
                        <th>Faculty ID</th> 
                        <th>Course ID</th>
                    </tr> 
                    </thead><tbody>";
    if(mysqli_num_rows($db) > 0) {
        if(mysqli_query($link,$sql)) {
            while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>".$row['FACULTY_NAME']."</td>";
                echo "<td>".$row['FACULTY_ID']."</td>";
                echo "<td>".$row['COURSE_ID']."</td>";
                echo "</tr>";
            }
        }
    }
    echo "</tbody><table>";

?> 