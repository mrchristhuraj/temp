<?php
    session_start();
    $course_id = $_REQUEST['course_id'];
    $TABLE_NAME = "coordinator_".$course_id."";
    
    include_once(__DIR__."/../../includes/sql.config.php");          
    $sql = "SELECT FACULTY_NAME,FACULTY_ID FROM $TABLE_NAME";
    $db = mysqli_query($link,$sql);
    if(!$db) 
        die("Failed to Insert: ".mysqli_error($link));


    echo '<div class="input-field col s12"><select id="facultySelectioID"><option value="" disabled selected>Select Faculty</option>';

    if(mysqli_num_rows($db) > 0) {
        while($row = mysqli_fetch_assoc($db)){
            $temp1 = $row['FACULTY_ID'];
            $temp2 = $row['FACULTY_NAME'];
            echo "<option value=\"".$temp1."\">".$temp1." - ".$temp2."</option>";
        }
    }

    echo '</select><label>Faculty Selection</label></div>';
   ?>