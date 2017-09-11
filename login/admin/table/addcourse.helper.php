<?php
    session_start();

    $TABLE_NAME = "COURSE_TABLE";

    
    include_once(__DIR__."/../../includes/sql.config.php");

    $sql = "SELECT * FROM $TABLE_NAME";
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
    echo "</tbody><table>";

?> 