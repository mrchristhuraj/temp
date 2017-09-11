<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION";
        exit;
    }
    
        include_once(__DIR__."/../../includes/sql.config.php");
        

    include_once(__DIR__."/../../includes/general.config.php");
        $username =  $_SESSION['uname'];
        $name = $_SESSION['name'];
        define('USERNAME',$username);
        $TABLE_NAME = "course_req_table";

        //TEMPORARY PURPOSE
        //Below code is used to find the frequency of student accessing home password_get_info

        $sql = "SELECT * FROM `FREQUENCY_TABLE` WHERE `REG_ID` = '$username'";
        $db = mysqli_query($link,$sql);
        if(mysqli_num_rows($db) == 0) {
            //Row Not Present
            $sql = "INSERT INTO `FREQUENCY_TABLE`(`REG_ID`, `COUNT`) VALUES ('$username',1)";
            $db = mysqli_query($link,$sql);
            if(!$db)
                die("Failed to Load: ".mysqli_error($link));
        }else {
            //Row Present
            $sql = "UPDATE `FREQUENCY_TABLE` SET `COUNT` = `COUNT`+1 WHERE `REG_ID` = '$username'";
            $db = mysqli_query($link,$sql);
            if(!$db)
                die("Failed to Load: ".mysqli_error($link));
        }
        if(!$db)
              die("Failed to Load: ".mysqli_error($link));

        //FREQ CODE END
        


        $sql = "SELECT COURSE_NAME ,COURSE_ID FROM `course_reg_table` WHERE STUD_ID = '$username' AND STATUS = 1;";

        $db = mysqli_query($link,$sql);

        if(!$db)
              die("Failed to Load: ".mysqli_error($link));
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
        }

        .title {
            font-size: 1.8em;
        }

        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }

        #padd {
            padding-bottom: 10px;
        }
        .choice:hover {
            margin: 0;
            background-color: #FFF;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
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
                    <li><a href="request.php">Request Course</a></li>
                    <li><a href="profile/index.php">Profile</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="card">
                <p id="top-bar" class="card-heading-main red white-text title">STUDENT HOME</p>
                <div class="card-content">
                    <p class="text">Registration Number:
                        <?php echo $_SESSION['uname'];?>
                    </p>
                    <p class="text">Name:
                        <?php echo $_SESSION['name']; ?> </p>
                    <br><br><br><br>


                    <?php
                        $coursecode;
                        if(mysqli_num_rows($db) > 0) {
                            echo "<p class=\"title\" id=\"padd\">COURSES REGISTERED </p>";
                            $num = 1;
                            $grid = 3;
                            while($row = mysqli_fetch_assoc($db)) {
                                    $coursecode = $row['COURSE_NAME'];
                                    $courseid= $row['COURSE_ID'];
                                    if($num%$grid == 1) {
                                        echo "<div class=\"row\">";
                                    }

                                    $TABLE_NAME_NEW = "STD_DB_".$username;
                                    $level_1 = $courseid."__1__";
                                    $level_2 = $courseid."__2__";
                                    $level_3 = $courseid."__3__";
                                    $sql_data = "SELECT (SELECT COUNT(*)  FROM `$TABLE_NAME_NEW` WHERE `STATUS` = 2 AND CAST(`SEQUENCE_ID` as CHAR) LIKE '$level_1' ) as NOS1,(SELECT COUNT(*)  FROM `$TABLE_NAME_NEW` WHERE `STATUS` = 2 AND CAST(`SEQUENCE_ID` as CHAR) LIKE '$level_2' ) as NOS2,(SELECT COUNT(*)  FROM `$TABLE_NAME_NEW` WHERE `STATUS` = 2 AND CAST(`SEQUENCE_ID` as CHAR) LIKE '$level_3' ) as NOS3;";
                                    $db_data = mysqli_query($link,$sql_data);
                                    if(!$db_data)
                                        die("Failed to Load: $sql_data ".mysqli_error($link));
                                    $row = mysqli_fetch_assoc($db_data);

                                    $level_1 = $row['NOS1']*10;

                                    $user_name = $_SESSION['uname'];
                                    $std_name = $_SESSION['name'];
                                    
                                    date_default_timezone_set("Asia/Kolkata");
                                    $created_date = date("Y-m-d H:i:s");

                                    
                                    
                                    $level_1 = ($row['NOS1']*10)."%";

                                    echo "<div class=\"col s12 m6 l4 course-data\">
                                            <div class=\"card choice center  red \">
                                                <div class=\"card-content white-text\">
                                                    <span class=\"card-title\">$coursecode</span>
                                                </div>
                                                <div class=\"card-action\">
                                                    <a class=\" blue-text text-lighten-4\">Level 1: <span class=\"white-text\">$level_1</span></a>
                                                </div>
                                            </div>
                                        </div>";


                                    if($num%$grid == 0) {
                                        echo "</div>";
                                    }
                                    $num++;
                            }
                            $num--;
                            if($num % $grid != 0) {
                                echo "</div>";
                            }

                        } else {
                            echo "<p class=\"title red-text center text-darken-2\"> No Courses Registered...<p>";
                        }
                        ?>
                </div>
            </div>
        </div>





        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>

    </html>
