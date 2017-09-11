<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'C') {
        echo "ERROR IN SESSION"; 
        exit;
    }
    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $course_name = $_SESSION['course_name'];
    $course_id = $_SESSION['course_id'];
    
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");
?>

<html>
<head>
<title>eVerify Add Question</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/materialize.min.css" type="text/css" /> 
<script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="addquestion.js" type="text/javascript"></script>
</head>
<style>
    .srm-text {
            margin-left: 30px;
        }
        
        nav div a img.logo-img {
            height: 100%;
            padding: 4px;
            margin-left: 40px;
        }
        .login {
            padding: 20px;
            font-size: 1.3em;

            text-transform: uppercase;
        }
        .text {
            font-size: 1em;
        }
        .title {
            margin: 50px;
            margin-bottom: 10px;
            margin-left: 0;
        }
        .btn {
            margin-top: 23px;
        }
        .switch label input[type=checkbox]:checked+.lever:after {
            background-color: #FFF;
        }
</style>
<body>
    <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../../logo.png"> </img></a>
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul id="nav-mobile" class="right">
                    <li><a href="../../index.php">Logout</a></li>
                    <li><a href="home.php">Home</a></li>
                </ul>
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="login red white-text">
                    Add Question
                    </div>  
                    <div class="card-content text">
                        <div class="row center"> <!-- Modify Row -->
                            <div class="switch">  <!-- Modify Switch -->
                                <label class="toggle_switch">
                                Add Question
                                <input type="checkbox">
                                <span class="lever pink"></span>
                                Modify Question
                                </label>
                            </div> <!-- Modify Switch -->
                        </div>  <!-- Modify Row -->

                        <div class="row" id="question_id_div">
                            <div class="col s6 offset-s3 input-field">
                                <input  id="question_id" type="text" class="validate">
                                <label for="question_id">Question ID</label>
                            </div>

                            <div class="col s3">
                                <a id="getDetailsButton" class=" btn waves-effect waves-light pink">+</a>
                            </div>
                        </div>

                        <div class="row" id="main_form_div"> <!-- REST BODY -->
                                <div class="row"> <!-- Session Row -->
                                    <div class="col s12 m4 input-field"> <!-- Question Row -->
                                        <input  id="question_name" type="text" class="validate">
                                        <label for="question_name">Question Name</label>
                                    </div>  <!-- Question Row -->

                                    <div id="level_div">
                                        <div class="col s12 m2 input-field">
                                            <select id="level_id">
                                            <option value="1">Level 1</option>
                                            <option value="2">Level 2</option>
                                            <option value="3">Level 3</option>
                                            </select>
                                            <label>Select Level</label>
                                        </div>
                                    </div>

                                     <div id="session_div">
                                    <div class="col s12 m6 input-field"> <!-- Session Row -->
                                        <select id="session_id">
                                        <?php
                                            $temp = $course_id."__";
                                            $sql = "SELECT * FROM SESSION_TABLE WHERE CAST(`COURSE_SESSION_ID` as CHAR) LIKE '$temp' ORDER BY COURSE_SESSION_ID ASC";
                                            $db = mysqli_query($link,$sql);
                                            if(mysqli_num_rows($db) > 0) {
                                                while($row = mysqli_fetch_assoc($db)) {
                                                    $temp1 = $row['COURSE_SESSION_ID'];
                                                    $temp2 = $row['SESSION_NAME'];
                                                    echo "<option value=\"".$temp1."\">".$temp2."</option>";
                                                }
                                            }

                                        ?>
                                        </select>
                                        <label>Select Session</label>
                                        </div>
                                    </div> <!-- Session Row -->
                                </div> <!-- Session Row -->

                                <div class="row"> <!-- Question Description Row -->
                                    <div class="input-field col s12">
                                        <textarea id="question_description" class="materialize-textarea"></textarea>
                                        <label for="question_description">Question Description</label>
                                    </div>
                                </div> <!-- Question Description Row -->
                                <div class="red-text text"><p>NOTE: Set Test Cases to 0, If not needed</p><p>INPUT AND OUTPUT is MUST</p></div>
                                <div class="row"> <!-- Test Case 1 Row -->
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase1_input" class="materialize-textarea"></textarea>
                                        <label for="testcase1_input">Test Case 1 INPUT</label>
                                    </div>
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase1_output" class="materialize-textarea"></textarea>
                                        <label for="testcase1_output">Test Case 1 OUTPUT</label>
                                    </div>
                                </div> <!-- Test Case 1 Row -->

                                <div class="row"> <!-- Test Case 2 Row -->
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase2_input" class="materialize-textarea"></textarea>
                                        <label for="testcase2_input">Test Case 2 INPUT</label>
                                    </div>
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase2_output" class="materialize-textarea"></textarea>
                                        <label for="testcase2_output">Test Case 2 OUTPUT</label>
                                    </div>
                                </div> <!-- Test Case 2 Row -->

                                <div class="row"> <!-- Test Case 3 Row -->
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase3_input" class="materialize-textarea"></textarea>
                                        <label for="testcase3_input">Test Case 3 INPUT</label>
                                    </div>
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase3_output" class="materialize-textarea"></textarea>
                                        <label for="testcase3_output">Test Case 3 OUTPUT</label>
                                    </div>
                                </div> <!-- Test Case 3 Row -->

                                <div class="row"> <!-- Test Case 4 Row -->
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase4_input" class="materialize-textarea"></textarea>
                                        <label for="testcase4_input">Test Case 4 INPUT</label>
                                    </div>
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase4_output" class="materialize-textarea"></textarea>
                                        <label for="testcase4_output">Test Case 4 OUTPUT</label>
                                    </div>
                                </div> <!-- Test Case 4 Row -->

                                <div class="row"> <!-- Test Case 5 Row -->
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase5_input" class="materialize-textarea"></textarea>
                                        <label for="testcase5_input">Mandatory 1</label>
                                    </div>
                                    <div class="col s12 m6 input-field">
                                        <textarea id="testcase5_output" class="materialize-textarea"></textarea>
                                        <label for="testcase5_output">Mandatory 2</label>
                                    </div>
                                </div> <!-- Test Case 5 Row -->


                        </div> <!-- REST BODY -->
                        <div class="row center" id = "add_question_button_div">
                                <a id="addQuestionBtn" class="waves-effect pink waves-light btn">Add Question</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    

    <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
</body>

  </html>  
