<?php
    define('DB_NAME','ELAB_DB');

    //Change Setting Below This
    define('DB_HOST', 'localhost');
    define('DB_USERNAME','elabuser');
    define('DB_PASSWORD','elabuserdbpassword');

    //Production Variables
    $DEBUG_MODE = false;
    //Change Setting Above This

    $final_result = Array();
    $link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    if(!$link){
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Cound Not Connected to MySQL: ".mysqli_error($link);
        echo json_encode($final_result);
        return;
    }
    $data_base = mysqli_select_db($link,DB_NAME);
    if(!$data_base) {
        $final_result['error'] = 1;
        $final_result['errorMsg'] = "Cound Not Connect to Data Base: ".mysqli_error($link);
        echo json_encode($final_result);
        return;
    }

    //Error Reporting 
    if($DEBUG_MODE) {
        error_reporting(-1);
        ini_set('display_errors', 'On');
    }
?>
