<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'C') {
        echo "ERROR IN SESSION";
        exit;
    }

        $username =  $_SESSION['uname'];
        $name = $_SESSION['name'];
        $temp = explode("_",$username,2);
        $course_name = strtoupper($temp[1]);
        $_SESSION['course_name'] = $course_name;
        
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");



   $sql = "SELECT * FROM `COURSE_TABLE` WHERE COURSE_NAME LIKE '$course_name';";

   $db = mysqli_query($link,$sql);
    if(!$db)
          die("Failed to Insert: ".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);

    $_SESSION['course_id'] = $row['COURSE_ID'];
    $TABLE_NAME = "coordinator_".$row['COURSE_ID'];


     $sql = "SELECT COUNT(DISTINCT(FACULTY_ID)) AS NOS FROM $TABLE_NAME";

     //$sql = "SELECT COUNT(DISTINCT(STAFF_ID)) AS NOS FROM `COURSE_REG_TABLE` WHERE COURSE_NAME LIKE '$course_name';";
     $db = mysqli_query($link,$sql);
        if(!$db)
            die("Failed to Insert: ".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);


     $faculty_count = $row['NOS'];


     $sql = "SELECT COUNT(*) AS NOS FROM COURSE_REG_TABLE WHERE COURSE_NAME LIKE '$course_name'";
     $db = mysqli_query($link,$sql);
        if(!$db)
            die("Failed to Insert: ".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);


     $student_count = $row['NOS'];

     $FLAG_NAME = $_SESSION['course_id']."_MAX_LVL";

     $sql = "SELECT * FROM FLAGS WHERE NAME LIKE '$FLAG_NAME'";
     $db = mysqli_query($link,$sql);
        if(!$db)
            die("Failed to Insert: ".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);
    $MAX_FLAG_VALUE = $row['VALUE'];


?>

    <html>

    <head>
        <title>eVerify Coordinator Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="home.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
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

        .card-heading-main {
            padding: 20px;
            font-weight: 300;
            margin-bottom: 15px;
        }

        .text {
            font-size: 1.2em;
        }

        .title {
            font-size: 1.8em;
        }
        .caps {
            text-transform: uppercase;
        }

        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        } box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .dropdown-regid {
            width: 100%;
        }
        .status {
            padding: 0 15px 0 15px;
        }
        .resultDiv {
            padding: 15px;
            font-size: 3em;
        }
    </style>

    <body>
        <ul id="dropdown1" class="dropdown-content right">
            <li><a href="profile/index.php" class="indigo-text text-darken-1">Profile</a></li>
            <li><a href="addfaculty.php" class="indigo-text text-darken-1">Faculty</a></li>
            <li><a href="report.php" class="indigo-text text-darken-1">Report</a></li>
            <li class="divider"></li>
            <li><a href="addquestion.php" class="indigo-text text-darken-1">Add Question</a></li>
            <li><a href="viewquestion.php" class="indigo-text text-darken-1">View Question</a></li>
            <li class="divider"></li>
            <li><a href="addsession.php" class="indigo-text text-darken-1">Add Session</a></li>
            <li><a href="modify.php" class="indigo-text text-darken-1">Change Student/ Faculty Password</a></li>
        </ul>

        
        <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../../logo.png"> </img></a>
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul class="right">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">More Options</a></li>
                    <li><a href="../../index.php">Logout</a></li>
                
                <ul>
    
                <!-- <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a> -->
         <!--       <ul class="right">
                </ul> -->
<!--
                <ul class="side-nav" id="nav-mobile">
                    <li><a href="../../index.php">Logout</a></li>
                    <li><a href="addfaculty.php">Faculty</a></li>
                    <li><a href="addquestion.php">Add Question</a></li>
                    <li><a href="viewquestion.php">View Question</a></li>
                    <li><a href="addsession.php">Add Session</a></li>
                    <li><a href="report.php">Report</a></li>
                </ul>  -->
            </div>
        </nav>

        <div class="container">
            <div class="card">
                <p id="top-bar" class="card-heading-main red caps white-text title">Coordinator Home</p>
                <div class="card-content">
                    <p class="text" >Course:
                        <span id="course_name_text"><?php echo $course_name;?></span>
                    </p>
                    <p class="text">Name:
                        <?php echo $_SESSION['name'] ?> </p>
                    <br>


                <p class="title">GENERAL STATISTICS</p>
                <div class="status">
                    <div class="row">

                        <div class="col s12 m6">
                            <div class="card">
                                <p class="card-heading-main red center white-text text">Number of Students</p>
                                <div class="card-content center-align">
                                    <a class="black-text  resultDiv"> <?php echo $student_count;?> </a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="card">
                                <p class="card-heading-main red center white-text text">Number of Faculties</p>
                                <div class="card-content center-align">
                                    <a  class="black-text resultDiv"><?php echo $faculty_count;?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="title">FACULTY STATISTICS</p>
                <div class="row">
                        <div class="input-field col s6">
                                    <select id="facultySelectioID">
                                    <option value="" disabled selected>Choose Faculty</option>
                                    <?php
                                        $sql_regid = "SELECT FACULTY_ID,FACULTY_NAME FROM $TABLE_NAME";
                                        $db_regid = mysqli_query($link,$sql_regid);
                                        if(!$db_regid)
                                            die("Failed to Insert: ".mysqli_error($link));
                                        if(mysqli_num_rows($db_regid) > 0) {
                                            if(mysqli_query($link,$sql_regid)) {
                                                while($row = mysqli_fetch_assoc($db_regid)){
                                                    $temp1 = $row['FACULTY_ID'];
                                                    $temp2 = $row['FACULTY_NAME'];
                                                    echo "<option value=\"".$row['FACULTY_ID']."\">".$temp1." - ".$temp2."</option>";
                                                }
                                            }
                                        }
                                    ?>
                                    </select>
                                    <label>Select Faculty</label>
                        </div>
                        <div class="col s12 m2">
                            <a id="viewDetailsBtn" class="waves-effect pink waves-light btn">VIEW</a>
                        </div>
                </div>
                <div class="status">

                        <div class="row">

                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red center white-text text">Students Completed Level 1</p>
                                <div class="card-content center-align">
                                    <a id="l1" class="black-text  resultDiv"> 0/0 </a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red center white-text text">Students Completed Level 2</p>
                                <div class="card-content center-align">
                                    <a id="l2" class="black-text resultDiv"> 0/0 </a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red center white-text text">Students Completed Level 3</p>
                                <div class="card-content center-align">
                                    <a id="l3" class="black-text resultDiv"> 0/0 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="title">SOLVE QUESTION</p>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                <input id="question_no_text_field" type="text">
                                <label for="first_name">Question Number</label>
                                </div><a id="solveQuestionBtn" class="waves-effect pink waves-light btn">SOLVE</a>
                        
                            </div>
                            </div>
                    </div>
                    <p class="title">MAX LEVEL QUESTION SELECTABLE</p>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                <select id="levelSelect">
                                <?php
                                    for($i=1;$i<=3;$i++) {
                                        if($i == $MAX_FLAG_VALUE)
                                            echo "<option selected value='$i'>Level $i</option>";
                                        else 
                                            echo "<option value='$i'>Level $i</option>";
                                    }

                                ?>
                                </select>
                                <label for="levelSelect">Select Max Level</label>
                                </div><a id="maxLevelUpdateBtn" class="waves-effect pink waves-light btn">UPDATE</a>
                            </div>
                            </div>
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
