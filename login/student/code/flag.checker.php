<?php

    include_once(__DIR__."/../../../includes/sql.config.php");

      $sql = "SELECT * FROM `flags`";
      $db = mysqli_query($link,$sql);
      if(!$db)
            die("Failed to Insert: ".mysqli_error($link));
      $row = null;
      if(mysqli_num_rows($db) > 0 ){
        while ($row = mysqli_fetch_assoc($db)) {
            if($row['NAME'] == 'COPY_CONTROL') {
              echo "".$row['VALUE'];
            }
          }
     }

// id 0 then, cannot copy
// if 1 the, can copy
?>
