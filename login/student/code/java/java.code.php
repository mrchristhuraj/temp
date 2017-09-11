<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION"; 
        exit;
    }

    $username =  $_SESSION['uname'];
    $name = $_SESSION['name'];
    $course_id = $_SESSION['course_id'];
    $course_name = trim($_SESSION['course_name']);
    $wheelID = $_REQUEST['id'];
    $wheelValue = $_REQUEST['value']; 
    $session = intval($wheelValue/10)+1;
    $overall = $wheelValue%100;
    $questionNumber = $wheelValue%10;

    $sequence_id = "".$course_id.($session+10).($wheelID).($questionNumber+11);
    $_SESSION['sequence_id'] = $sequence_id;

    $TABLE_NAME = "STD_DB_$username";
  
    include_once(__DIR__."/../../../../includes/sql.config.php");
    include_once(__DIR__."/../../../../includes/general.config.php");
    /*
    if($wheelID == 2) {
        $id_new = "".$course_id."__1__";
          $sql_check1 = "SELECT * FROM $TABLE_NAME WHERE CAST(SEQUENCE_ID as CHAR) LIKE '$id_new' AND STATUS = 2";
          $db_check1 = mysqli_query($link,$sql_check1);
          if(mysqli_num_rows($db_check1) !== 100) {
            echo "WRONG TRY :-)  ATTEMPTED ONLY: ".mysqli_num_rows($db_check1);
            exit;
          }
    }else if($wheelID == 3) {
        $id_new = "".$course_id."__2__";
        $id_new_2 = "".$course_id."__1__";
          $sql_check1 = " SELECT * FROM $TABLE_NAME WHERE (CAST(SEQUENCE_ID as CHAR) LIKE '$id_new' OR CAST(SEQUENCE_ID as CHAR) LIKE '$id_new_2') AND STATUS = 2";
          $db_check1 = mysqli_query($link,$sql_check1);
          if(mysqli_num_rows($db_check1) !== 200) {
            echo "WRONG TRY :-) ATTEMPTED ONLY: ".mysqli_num_rows($db_check1);
            exit;
          }
    }
    */

    $sql = " SELECT * FROM $TABLE_NAME WHERE SEQUENCE_ID = '$sequence_id'";
    $db = mysqli_query($link,$sql);

    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));
    

    if(mysqli_num_rows($db) > 0)
                $row = mysqli_fetch_assoc($db);
    else {
        echo "Question $sequence_id NOT ALLOCATED. CONTACT ADMIN";
        exit;
    }



    $sql2 = "UPDATE $TABLE_NAME SET STATUS = 1 WHERE CAST(SEQUENCE_ID as CHAR) LIKE '$sequence_id' AND STATUS = 0";

    $db2 = mysqli_query($link,$sql2);

    if(!$db2) 
          die("Failed to Insert: ".mysqli_error($link));


?>

<html>
    <head>
        <link rel="icon" href="./../../../../favicon.ico">
    <title>eVerify Java Question</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../../../../css/materialize.min.css" type="text/css" />
    <link rel="stylesheet" href="../../../../Code-mirror/lib/codemirror.css">           
    </head>
    <style>
        nav div a img.logo-img {
            height: 100%;
            padding: 4px;
            margin-left: 40px;
        }
        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }
        .text {
            font-size: 1.2em;
            font-weight: 400;
        }
        #hidden {
            display: none;
        }
        .content {
            margin-top: 15px;
        }
        .login {
            padding: 20px;
            font-size: 1.3em;
        }
        .collection {
            margin-top: 0;
            margin-bottom: 0;
        }
        .btn {
            min-width: 200px;
        }
      
      
</style>

    
    <body>
        <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../../../../logo.png" />
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul id="nav-mobile" class="right">
                    <li><a href="../../../../index.php">Logout</a></li>
                    <li><a href="../../home.php">Home</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="card">
                <div class="login red white-text">CODING AREA</div>
                    
                <div class="card-content"><p>Name: <a>
                    <?php
                        echo $name;
                    ?>
                    </a></p>
                    <p>Registration Number: <a>
                    <?php
                        echo $username;
                    ?>
                    </a></p>
                </div>
            </div>
            </div>
        </div>

        <div class="main_div">
            <div class="row">
                <div class="col s12 m12 l4 question_div">
                    <div class="card ">
                        <div class="login red white-text">QUESTION</div>
                        <ul class="collection">
                        <li class="collection-item"><b>Session</b>: <?php echo $row['S_NAME']; ?></li>
                        <li class="collection-item"><b>Q.<?php echo $row['SEQUENCE_ID']; ?></b>: <?php echo $row['Q_NAME'] ?></li>
                        <li class="collection-item"><b>Question Description<br></b>
                        <p><?php echo nl2br($row['Q_DESC']); ?></p></li>
                        <li class="collection-item">
                        <b>Test Case 1</b>
                        <br>
                        <p><b>Input</b><p>
                        <p><?php
                            $tc1 = $row['TESTCASE_1'];
                            $TESTCASE1 = explode('###---###SEPERATOR---###---',$tc1,2);
                            echo nl2br($TESTCASE1[0]);
                        ?></p>
                        <p><b>Output</b></p>
                        <p><?php
                            echo nl2br($TESTCASE1[1]);
                        ?></p>
                        </li>
                        <li class="collection-item"><b>Test Case 2</b><br>
                        <p><b>Input</b><p>
                        <p><?php
                            $tc2 = $row['TESTCASE_2'];
                            $TESTCASE2 = explode('###---###SEPERATOR---###---',$tc2,2);
                            echo nl2br($TESTCASE2[0]);
                        ?></p>
                        <p><b>Output</b></p>
                        <p><?php
                            echo nl2br($TESTCASE2[1]);
                        ?></p></li>
                        </ul>
                        
                        <div class="login center indigo darken-4 white-text" id="resultMsg">RESULT</div>
                        <div class="center indigo darken-4 ">
                         

                        </div>
                    </div>
                </div>

                <div class="col s12 m12 l8">
                    <div class="card">
                        <div class="login red white-text">CODE <?php echo $course_name;?></div>
                        <div class="card-content">
                            <div class="codeEditorDiv">
                                <div id="codeEditor">

                                </div>         
                            </div>
                                <div class="row">
                                
                            <h5 class="title login red white-text">INPUT</h5>
                                    <div class="input-field">
                                    <textarea id="inputText" class="materialize-textarea"></textarea>
                                    </div>
                            </div>
                            <h5 class="title  login red white-text">OUTPUT</h5>
                                <div class="center" id="waitingCircle">
                                            <div class="preloader-wrapper active">
                                                <div class="spinner-layer spinner-blue">
                                                    <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                    </div><div class="gap-patch">
                                                    <div class="circle"></div>
                                                    </div><div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                    </div>
                                                </div>

                                                <div class="spinner-layer spinner-red">
                                                    <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                    </div><div class="gap-patch">
                                                    <div class="circle"></div>
                                                    </div><div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                    </div>
                                                </div>

                                                <div class="spinner-layer spinner-yellow">
                                                    <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                    </div><div class="gap-patch">
                                                    <div class="circle"></div>
                                                    </div><div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                    </div>
                                                </div>

                                                <div class="spinner-layer spinner-green">
                                                    <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                    </div><div class="gap-patch">
                                                    <div class="circle"></div>
                                                    </div><div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                    </div>
                                                </div>
                                                </div>
                                </div>

                            <div class="row">
                                
                                <div class="col s12 text" id="asd">
                                    <b><code id="outputMsg"></code></b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 right-align">
                                   <a class="waves-effect waves-light btn blue" id="runButton">RUN</a>
                                </div>
                                <div class="col s6">
                                    <a class="waves-effect waves-light btn pink" id="evaluateButton">EVALUATE</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
        
        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../../../js/materialize.min.js"></script>
        <script type="text/javascript" src="../../../../Code-mirror/lib/codemirror.js"></script>
        <script type="text/javascript" src="../../../../Code-mirror/mode/clike/clike.js"></script>
        <script src="code.elab.js" type="text/javascript"></script>
        <!-- DONT CHANGE ABOVE IT -->
    
    </body>

</html>
