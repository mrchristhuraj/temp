<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'O') {
        echo "ERROR IN SESSION";
        exit;
    }

        $username =  $_SESSION['uname'];
        $name = $_SESSION['name'];
        $temp = explode("_",$username,2);
        $c_name = $temp[1];
        $course_name = strtoupper($c_name);
        $_SESSION['course_name'] = $course_name;
        $TABLE_NAME = "course_req_table";
    include_once(__DIR__."/../../includes/sql.config.php");


    include_once(__DIR__."/../../includes/general.config.php");

   $sql = "SELECT * FROM `COURSE_TABLE` WHERE COURSE_NAME LIKE '$course_name';";

   $db = mysqli_query($link,$sql);
    if(!$db)
          die("Failed to Insert: ".mysqli_error($link));

    $row = mysqli_fetch_assoc($db);

    $_SESSION['course_id'] = $row['COURSE_ID'];

$count_data = Array();

    $sql = "SELECT ROLE,COUNT(*) as count FROM USERS_TABLE GROUP BY ROLE";

   $db = mysqli_query($link,$sql);
    if(!$db)
          die("Failed to Insert: ".mysqli_error($link));

    $count_data['C'] = 0;
    $count_data['S'] = 0;
    $count_data['F'] = 0;

    while($row = mysqli_fetch_assoc($db)) {
        if($row['ROLE'] == 'C') {
            $count_data['C'] = $row['count'];
        }else if($row['ROLE'] == 'S') {
            $count_data['S'] = $row['count'];
        }else if($row['ROLE'] == 'F') {
            $count_data['F'] = $row['count'];
        }
    }

    

    $_SESSION['course_id'] = $row['COURSE_ID'];



?>

    <html>

    <head>
        <link rel="icon" href="./../../favicon.ico">
        <title>eVerify Home</title>
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
            font-weight: 400;
            text-transform: uppercase;
        }

        .title {
            font-size: 1.5em;
            text-transform: uppercase;
        }

        .title2 {
            font-size: 1.8em;
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
        .resultDiv,.textBox {
            padding: 15px;
            font-size: 3em;
        }
        .switch label input[type=checkbox]:checked+.lever:after {
            background-color: #FFF;
        }
        .switch {
          padding-left: 12px;
        }
        .btnCollection > a{
            min-width: 300px;
            max-width: 90%;
        }
    </style>

    <body>
        <nav>
        <ul id="dropdown1" class="dropdown-content right">
            <li><a href="profile/index.php" class="indigo-text text-darken-1">Profile</a></li>
            <li class="divider"></li>
        </ul>

            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../../logo.png"> </img>
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul id="nav-mobile" class="right">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">More Options</a></li>
                    <li><a href="../../index.php">Logout</a></li>
                     <!-- To delete Profile, delete this line and delete profile folder -->
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="card">
                <p id="top-bar" class="card-heading-main red white-text title">Admin Home</p>
                <div class="card-content">
                    <div class="row">
                        <div class="offset-m4 offset-l4 col s12 m4 l4 course-data">
                            <div class="card-panel center  red reportBtn">
                                <span class="white-text">
                                        <a class="white-text text">Reports<a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="resultDiv" class="row center">
                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red white-text text">Number of Courses</p>
                                <div class="card-content">
                                    <a id="l1" class="black-text resultDiv"> <?php echo $count_data['C'];?> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red white-text text">Number of Faculties</p>
                                <div class="card-content">
                                    <a id="l2" class="black-text resultDiv"><?php echo $count_data['F'];?> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="card">
                                <p class="card-heading-main red white-text text">Number of Students</p>
                                <div class="card-content">
                                    <a id="l3" class="black-text resultDiv"> <?php echo $count_data['S'];?> </a>
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
