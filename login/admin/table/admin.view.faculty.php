<?php
                $userid = $_SESSION['uname'];
                $userid = $_SESSION['uname'];
                $faculty_id=$_REQUEST['faculty'];
                define('DB_NAME','ELAB_DB');
                define('DB_HOST', 'localhost');
                define('DB_USERNAME','reezpatel');
                define('DB_PASSWORD','reez1234');
                $link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);

                if(!$link)
                    die("Cound Not Connected to MySQL: ".mysqli_error($link));

                $data_base = mysqli_select_db($link,DB_NAME);

                if(!$data_base)
                    die("Cound Not Connect to Data Base: ".mysqli_error($link));
    ?>
        </h5><br>
    </div>
    <div class="view_faculty">
                   <?php
        
        $TABLE_NAME = 'faculty_'.$faculty_id;
        

        $link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);

        if(!$link)
              die("Cound Not Connected to MySQL: ".mysqli_error($link));

        $data_base = mysqli_select_db($link,DB_NAME);

        if(!$data_base)
              die("Cound Not Connect to Data Base: ".mysqli_error($link));
    ?>
        </h5><br>
    </div>

    <table id="table">
    <thead>
       <tr>
            <td><b>STUD_ID</b></td>
            <td><b>STUD_NAME</b></td>
            <td><b>COURSE_NAME</b></td>
            <td><b>COURSE_ID</b></td> 
            <td><b>LEVEL_1</b></td>
            <td><b>LEVEL_2</b></td>
            <td><b>LEVEL_3</b></td>
            <td><b>REQ_ID</b></td>
       </tr> 
    </thead>
    <tbody id="tBody">
            <?php
            $sql = " SELECT * FROM $TABLE_NAME";
    

        $db = mysqli_query($link,$sql);
    


        if(!$db) 
              die("Failed to Insert: ".mysqli_error($link));
    
        if(mysqli_num_rows($db) > 0) {
              while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>";
                echo $row['STUD_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['STUD_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['COURSE_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['COURSE_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['LEVEL_1'];
                echo "</td>";
                echo "<td>";
                echo $row['LEVEL_2'];
                echo "</td>";
                echo "<td>";
                echo $row['LEVEL_3'];
                echo "</td>";
                echo "<td>";
                echo $row['REQ_ID'];
                echo "</td>";
                echo "</tr>";
            
                }
        }    
        ?>  
                </div>