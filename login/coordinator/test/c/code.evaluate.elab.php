<?php
    session_start();
    $username =$_SESSION['uname'];

    
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];

    $q_id = $_SESSION['q_id'];

    $result = 0;
    $TABLE_NAME = $course_name."_QUESTION_TABLE";
    
    include_once(__DIR__."/../../../../includes/sql.config.php");
    include_once(__DIR__."/../../../../includes/node.config.php");
        
    $sql = "SELECT * FROM $TABLE_NAME WHERE Q_ID = '$q_id'";

    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));

    if(mysqli_num_rows($db) > 0)
                $row = mysqli_fetch_assoc($db);

    $TESTCASES = Array($row['TESTCASE_1'],$row['TESTCASE_2'],$row['TESTCASE_3'],$row['TESTCASE_4'],$row['TESTCASE_5']);
    $faculty_id = $row['STAFF_ID'];
	$code = $_REQUEST['code'];
    $_SESSION['code'] = $code;
	$input = $_REQUEST['input'];

    $inputs = Array();
    $answers = Array();
    $c = 0;
    for($i=0;$i < 4;$i++) {
        $elab_io = explode('###---###SEPERATOR---###---',$TESTCASES[$i],2);
        if(trim($elab_io[0]) != "0" || trim($elab_io[1]) != "0") {
            $inputs[$c] = trim($elab_io[0]);
            $answers[$c] = trim($elab_io[1]); 
            $c++;
        }
    }

    $postData = array(
		'api-key' => 'reezpatel',
		'language'=> 'c',
        'mode' => 'verify',
		'inputs'=> $inputs,
		'code'=> $code
	);

	$ch = curl_init($BASE_PATH.'/api/v1/code/');
	curl_setopt_array($ch, array(
		CURLOPT_POST => TRUE,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
		CURLOPT_POSTFIELDS => json_encode($postData)
	));
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

    $time_start = microtime(true);

	$response = curl_exec($ch);
	if($response === FALSE){
		die(curl_error($ch));
	}
	$responseData = json_decode($response);
	$outputs = json_decode($responseData->output);

    $statusCode = "".$responseData->statusCode;
    

    if($statusCode !== "200") {
        $finals_results['error'] = 1;
        $finals_results['error_msg'] = '<span class="red-text text-darken-3">'.nl2br(htmlspecialchars($responseData->errorMsg)).'<span>';
        echo json_encode($finals_results);
        exit;
    }

    $count = 0;
    $success_count = 0;

    $outputs_array = Array();

    for($i = 0;$i < $c;$i++) {
        $current_outputs = ($outputs[$i]);
        
        if($current_outputs->statusCode != "200") {
            $finals_results['error'] = 1;
            $finals_results['error_msg'] = '<span class="red-text text-darken-3">'.$current_outputs->errorMsg.'<span>';
            echo json_encode($finals_results);
            exit;
        }
        
        $outputs_array[$i] = $current_outputs->output;

        if($answers[$i] != "0" || $inputs[$i] != "0") {
            $count++;

            $string1 = trim($current_outputs->output);
            $string2 = $answers[$i];

$string1 = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $string1);
$string2 = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $string2);

            if(trim($string1) == trim($string2)) {
                $success_count++;
            }
        }
    }

/*
    if($TESTCASES[4] != '0') {
        $elab_io = explode('###---###SEPERATOR---###---',$TESTCASES[4],2);
        $elab_io[0] = trim($elab_io[0]);
        $elab_io[1] = trim($elab_io[1]);

        if(trim($elab_io[0]) != "0") {
                $count++;
            if(strpos($code,$elab_io[0]) !== false) {
                $success_count++;
            }
        }

        if(trim($elab_io[1]) != "0") {
            $count++;
            if(strpos($code,$elab_io[1]) !== false) {
                $success_count++;
            }
        }
    }
*/
    $time_end = microtime(true);
    $time = (float)((int)(($time_end - $time_start)*10000000));
    $time = $time / 10000000;


    $result = ($success_count/$count)*100;

    $finals_results['error'] = 0;
    $finals_results['execution_time'] = $time;
    $finals_results['score'] = $result;


    echo json_encode($finals_results);
?>
