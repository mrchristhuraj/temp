<?php
      $userid = $_SESSION['uname'];
      $userid = $_SESSION['uname'];
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
<div class="view_course_req">
                   <?php
        
        $TABLE_NAME = 'course_reg_table';
        

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
           <td><b>STAFF_ID</b></td>
           <td><b>COURSE_ID</b></td> 
            <td><b>COURSE_NAME</b></td>
           <td><b>STUD_NAME</b></td>
           <td><b>STUD_ID</b></td>
           <td><b>STATUS</b></td>
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
                echo $row['STAFF_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['COURSE_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['COURSE_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['STUD_NAME'];
                echo "</td>";
                echo "<td>";
                echo $row['STUD_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['STATUS'];
                echo "</td>";
                echo "<td>";
                echo $row['REQ_ID'];
                echo "</td>";
                echo "</tr>";
            
                }
        }    
        ?>  
                </div>
