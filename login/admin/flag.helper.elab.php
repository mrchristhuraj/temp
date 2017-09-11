<?php
session_start();
if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'A') {
    echo "ERROR IN SESSION";
    exit;
}


    include_once(__DIR__."/../../includes/sql.config.php");
      $final_result['error'] = 0;

      if($_POST['mode'] == 'get') {
      $sql = "SELECT * FROM `flags`";
      $db = mysqli_query($link,$sql);
      if(!$db) {
            $final_result['error'] = 1;
            $final_result['errorMsg'] = mysqli_error($link);
            echo $final_result;
      }
      $row = null;
      if(mysqli_num_rows($db) > 0 ){
          while ($row = mysqli_fetch_assoc($db)) {
                  $final_result[$row['NAME']] = $row['VALUE'];
          }
      }

      echo json_encode($final_result);

}else if($_POST['mode'] == 'set') {
      $mode = intval($_REQUEST['val']);
      $name = trim($_REQUEST['name']);
      $sql = "UPDATE `flags` SET `VALUE`=$mode WHERE `NAME` LIKE '$name'";
      $db = mysqli_query($link,$sql);
      if(!$db)
            die("Failed to Insert: ".mysqli_error($link));

      echo '1';
}else {
  echo 'INVALID REQUEST';
}


?>
