<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION";
        exit;
    }


    include_once(__DIR__."/../../../includes/sql.config.php");
    include_once(__DIR__."/../../../includes/node.config.php");

    $username = $_SESSION['uname'];
   
   
    $sequence_id = $_SESSION['sequence_id'];
    $course_name = trim($_SESSION['course_name']);
    $TABLE_NAME = "STD_DB_".$username;
    

    


    $sql = "SELECT * FROM `$TABLE_NAME` WHERE SEQUENCE_ID = '$sequence_id' AND STATUS = 2 LIMIT 1;";
    $db = mysqli_query($link,$sql);
    if(!$db)
            die("Failed to Load: ".mysqli_error($link));

     if(mysqli_num_rows($db)  == 0) {
         die("ERROR QUESTION NOT CLEARED");
     }else {
        $row = mysqli_fetch_assoc($db);
     }

     $qdesc = $row['Q_DESC'];
     $qname = $row['Q_NAME'];
     $sname = $row['S_NAME'];

	date_default_timezone_set('UTC');
     $today = date("F j, Y, g:i a");


     $elab_io = explode('###---###SEPERATOR---###---',$row['TESTCASE_1'],2);

     $html = "<html>
<head>
<title>eVerify Report</title>




<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
</head>
<style>
    .container {
        margin-top: 15px;
    }
    .innerContainer {
        border: 1px solid black;
        clear: both;
        padding: 12px;
    }
    body {

        font-family: sans-serif;
    }
    .right {
        float: right;
    }
    .left {
        float: left;
    }
    .container {
	position: relative;
	margin: auto;
	width: 990px;
	height: auto;
    }
    .row {
        margin: 5px;
    }
    .printBtn {
        text-align:center;
    }
</style>

<body>
    <div class=\"container\">
        <div class=\"upperContainer\">
            <table>
                <tr>
                    <td>
                <p><b>Course:</b> $course_name </p></td>
		<td>
                <p><b>Session:</b> $sname </p></td>
		<td>
                <p><b>Timestamp:</b> $today </p></td>
			 
                    <td>
                <p class=\"right\"><b>Register Number:</b> $username </p></td>
                </tr>
            </table>
        </div>
        <div class=\"innerContainer\">
            <div class=\"questionContainer\">
                <p><b>Q. $qname </b></p>
                <p> $qdesc </p>
            </div>
            <br>
            <div class=\"codeContainer\">
            <p><b>Source Code</b></p>
            <pre>".htmlspecialchars($row['CODE'])."
            </pre>
            </div>

            <div class=\"ioconatiner\">
                <p><b>Sample Input</b></p>
                <pre>".trim($elab_io[0])."</pre>
                <p><b>Sample Output</b></p>
                <pre>".trim($elab_io[1])."</pre>
            </div>

            <div class=\"resultContainer\">
                <p><b>Result</b></p>
                <p>Thus, Program \"<b> $qname </b>\" has been successfully executed</p>
            </div>
        </div>



    </div>

</body>
</html>";

    $postData = array(
		'html'=> $html,
	);

	$ch = curl_init($BASE_PATH.'/api/v1/image/');
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

    

   $im = imagecreatefromstring($response);


    header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="report.png"');

    imagepng($im);
    imagedestroy($im);


    header("location:javascript://history.go(-1)");


?>
