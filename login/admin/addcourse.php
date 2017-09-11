<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'A') {
        echo "ERROR IN SESSION"; 
        exit;
    }

        $username =  $_SESSION['uname'];
        $name = $_SESSION['name'];
        $temp = explode("_",$username,2);
        $course_name = strtoupper($temp[1]);
        $_SESSION['course_name'] = $course_name;
        $TABLE_NAME = "course_req_table";
    include_once(__DIR__."/../../includes/sql.config.php");


    include_once(__DIR__."/../../includes/general.config.php");
    
   $sql = "SELECT * FROM `COURSE_TABLE` ORDER BY `COURSE_ID` ASC;";

   $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".m0ysqli_error($link));

    $row = mysqli_fetch_assoc($db);

    $_SESSION['course_id'] = $row['COURSE_ID'];

        
?>

    <html>

    <head>
        <title>eVerify Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="addcourse.js" type="text/javascript"></script>
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
            font-size: 1.4em;
            
            text-transform: uppercase;
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
        .btn-large,.btn-flat {
            margin-top: 12px;
        }
    </style>

    <body>
        <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"> <img id="image" class="brand-logo logo-img s2" src="../../logo.png"> </img>
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
                <p id="top-bar" class="card-heading-main red white-text title">Courses</p>
                <div class="card-content">
                    <div class="row">

                        <div class="col s12 m5 l5">
                            <h5>COURSES AVAILABLE</h5><br>
                            <div id="courseTable"></div>
                        </div>

                       <!--
                            <div class="col s12 m7 l7" >
                            <h5> </h5>
                            <div class="row center">
                                a class="waves-effect pink waves-light btn-large addCourseBtn hidden">ADD COURSE</a> 
                            </div>
                            <div class="row"  id="addBtnDiv">
                                <div class="col s12 m8 left-text">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="course_name" type="text" class="validate course_name">
                                        <label for="course_name">Course Name</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col s12 m4">
                                    <a class="waves-effect pink waves-light btn-flat white-text" id="addBtn">ADD</a>
                                </div>
                            </div>
                        </div> -->

                        <div class="row center" id="loadingDiv">
                            <div class="preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
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

                        <div class="row center" id="errorDiv">
                        
                        </div>

                    </div> <!-- ROW -->
                </div> <!-- CARD CONTENT -->
            </div> <!-- CARD -->
        </div> <!-- CONTAINER -->


 


        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>

    </html>