<?php
                $userid = $_SESSION['uname'];
                $userid = $_SESSION['uname'];
                $course_name=$_REQUEST['course'];
                $question_id=$_REQUEST['id'];
                $question_name=$_REQUEST['name'];
                $question_name_new = "%".$question_name."%";
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
    <div class="viewquestion">
                   <?php
        
        $TABLE_NAME = $course_name.'_question_table';
        

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
           <td><b>Q_ID</b></td>
           <td><b>S_NAME</b></td> 
           <td><b>Q_NAME</b></td>
           <td><b>Q_DESC</b></td>
           <td><b>TESTCASE_1</b></td>
           <td><b>TESTCASE_2</b></td>
           <td><b>TESTCASE_3</b></td>
           <td><b>TESTCASE_4</b></td>
           <td><b>TESTCASE_5</b></td>
       </tr>
    </thead>
    <tbody id="tBody">
            <?php
            if($question_name){
            $sql = " SELECT * FROM $TABLE_NAME WHERE `Q_NAME` like \"$question_name_new\"";
        echo $sql;

        $db = mysqli_query($link,$sql);
    


        if(!$db) 
              die("Failed to Insert: ".mysqli_error($link));
    
        if(mysqli_num_rows($db) > 0) {
              while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>";
                echo $row['Q_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['S_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['Q_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['Q_DESC'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_1'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_2'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_3'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_4'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_5'];
                echo "</td>";
                echo "</tr>";
            
                }
        }} 
        if(!$question_name){
            $sql = " SELECT * FROM $TABLE_NAME WHERE `Q_ID` like \"$question_id\"";
        echo $sql;

        $db = mysqli_query($link,$sql);
    


        if(!$db) 
              die("Failed to Insert: ".mysqli_error($link));
    
        if(mysqli_num_rows($db) > 0) {
              while($row = mysqli_fetch_assoc($db)) {
                echo "<tr>";
                echo "<td>";
                echo $row['Q_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['S_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['Q_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['Q_DESC'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_1'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_2'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_3'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_4'];
                echo "</td>";
                echo "<td>";
                echo $row['TESTCASE_5'];
                echo "</td>";
                echo "</tr>";
            
                }
        }}   
        ?>  
                </div>
