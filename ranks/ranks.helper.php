<?php
    include_once(__DIR__."/../includes/sql.config.php");
    $course_id = mysqli_escape_string($link,$_REQUEST['course_id']);
    $level = mysqli_escape_string($link,$_REQUEST['level']);



    $sql = "SELECT * FROM `RANK_TABLE` WHERE `COURSE_ID` = $course_id AND `LEVEL` = $level ORDER BY `TIMESTAMP` ASC";

    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));
    if(mysqli_num_rows($db) == 0) {
        echo "<h4 class=\"center-align red-text text-darken-3\"> List is empty </h4>";
        return;
    }


    $count = 0;
    echo "<table id=\"table_display_data\" class=\"bordered highlight\"><thead><tr><th>Rank</th><th>Registration Number</th><th>Student Name</th></tr></thead><tbody>";
    if(mysqli_num_rows($db) > 0) {
        while($row = mysqli_fetch_assoc($db)) {
            $count++;
            echo "<tr>";
            echo "<td>".$count."</td>";
            echo "<td>".$row['REG_ID']."</td>";
            echo "<td>".$row['STD_NAME']."</td>";
            echo "</tr>";
        }
    }
    echo "</tbody><table>";
                            
    

?>