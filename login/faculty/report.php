<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'F') {
        echo "ERROR IN SESSION";
        exit;
    }

    $username =  $_SESSION['uname'];
    $name = $_SESSION['name'];
        
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");
?>

    <html>

    <head>
        <link rel="icon" href="./../../favicon.ico">
<title>eVerify Question</title>
    <script src="../student/libraries/RGraph.common.core.js"></script>
    <script src="../student/libraries/RGraph.drawing.circle.js"></script>
    <script src="../student/libraries/RGraph.drawing.text.js"></script>
    <script src="../student/libraries/RGraph.common.dynamic.js"></script>
    <script src="../student/libraries/RGraph.common.tooltips.js"></script>
    <script src="../student/libraries/RGraph.common.key.js"></script>
    <script src="../student/libraries/RGraph.pie.js"></script>
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
            text-transform: uppercase;

        }
        .caps {
            text-transform: uppercase;
        }
        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }
        .card-panel:hover {
            margin: 0;
            background-color: #FFF;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .dropdown-regid {
            width: 100%;
        }
        .resultDiv {
            padding: 15px;
            font-size: 3em;
        }
        .cl-fs {
            clear: both;
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
            <div class="card">
                <p id="top-bar" class="card-heading-main red white-text title">Student detailed Report</p>
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m6">
                             <div class="input-field col s12">
                                <select id="studentSelect">
                                    <option value="0" disabled selected>Select Student</option>
                                    <?php
                                $sql_regid = "SELECT DISTINCT STUD_ID,STUD_NAME FROM `FACULTY_$username`";
                                $db_regid = mysqli_query($link,$sql_regid);
                                if(!$db_regid)
                                    die("Failed to Insert: ".mysqli_error($link));
                                if(mysqli_num_rows($db_regid) > 0) {
                                    if(mysqli_query($link,$sql_regid)) {
                                        while($row = mysqli_fetch_assoc($db_regid)){
                                            $temp1 = $row['STUD_ID'];
                                            $temp2 = $row['STUD_NAME'];
                                            echo "<option value=\"".$row['STUD_ID']."\">".$temp1." - ".$temp2."</option>";
                                        }
                                    }
                                }
                                ?>
                                </select>
                                <label>Student ID</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                             <div class="input-field col s12" id="courseSelectionDiv">
                                <select id="courseSelect"></select>
                                <label>Course</label>
                            </div>
                        </div>
                    </div>    
                    <div class="row right">
                        <a class="btn pink" id="viewDetailsButton">View Details</a>
                    </div>

                    
        <div class="row" id="canvasSection">
            <div class="col s12 center">

                    <br><br>
                <canvas id="graphCanvas" width="900" height="900"></canvas>
                <div class="row">
                    <div class="col s12 m4">
                        <h5>Level 1 : &nbsp;&nbsp;<b><span id="L1Text"></span>%</b></h5>
                    </div>
                    <div class="col s12 m4">
                        <h5>Level 2: &nbsp;&nbsp;<b><span id="L2Text"></span>%</b></h5>
                    </div>
                    <div class="col s12 m4">
                        <h5>Level 3: &nbsp;&nbsp;<b><span id="L3Text"></span>%</b></h5>
                    </div>
                </div>
            </div>
        </div>


                    <div class="cl-fs"> </div>              
                </div>
            </div>
        </div>





        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <script type="text/javascript" src="report.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>

    </html>
