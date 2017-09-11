<?php
      $userid = $_SESSION['uname'];
      $userid = $_SESSION['uname'];
      $registration_no=$_REQUEST['regid'];
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

<div class="view_student">
        <?php
        $TABLE_NAME= 'std_db_'.$registration_no;


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
           <td><b>SEQUENCE_ID</b></td> 
           <td><b>S_NAME</b></td>
           <td><b>Q_NAME</b></td>
           <td><b>Q_DESC</b></td>
           <td><b>TESTCASE_1</b></td>
           <td><b>TESTCASE_2</b></td>
           <td><b>TESTCASE_3</b></td>
           <td><b>TESTCASE_4</b></td>
           <td><b>TESTCASE_5</b></td>
           <td><b>STATUS</b></td>
           <td><b>CODE</b></td>
           <td><b>IO</b></td>
           <td><b>OTHER_INFO</b></td>
           <td><b>DATE_STARTED</b></td>
           <td><b>DATE_ENDED</b></td>
           <td><b>FILES</b></td>
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
                echo $row['SEQUENCE_ID'];
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
                //echo $row['TESTCASE_5'];
                echo "</td>";
                echo "<td>";
                echo $row['STATUS'];
                echo "</td>";
                echo "<td>";
                echo $row['CODE'];
                echo "</td>";
                echo "<td>";
                echo $row['IO'];
                echo "</td>";
                echo "<td>";
                echo $row['OTHER_INFO'];
                echo "</td>";
                echo "<td>";
                echo $row['DATE_STARTED'];
                echo "</td>";
                echo "<td>";
                echo $row['DATE_ENDED'];
                echo "</td>";
                echo "<td>";
                echo $row['FILES'];
                echo "</td>";
                echo "</tr>";
            
                }
        }    
        ?>
                     
                </div>