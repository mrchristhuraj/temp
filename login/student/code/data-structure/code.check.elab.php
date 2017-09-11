<?php
    session_start();

	//$username =$_SESSION['uname'];

    include_once(__DIR__."/../../../../includes/node.config.php");

	$code = $_REQUEST['code'];
	$input = $_REQUEST['input'];
	$language = $_REQUEST['language'];

	$postData = array(
		'api-key' => 'reezpatel',
		'language'=> "$language",
		'input'=> $input,
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

	$response = curl_exec($ch);
	if($response === FALSE){
		die(curl_error($ch));
	}
	$responseData = json_decode($response, TRUE);
	
	if($responseData['statusCode'] == "200") {
		echo nl2br(htmlspecialchars($responseData['output']));
	}else {
		echo '<span class="red-text text-darken-3">'.nl2br(htmlspecialchars($responseData['errorMsg']))."</span>";
	}

?>
