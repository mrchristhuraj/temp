<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION"; 
        exit;
    }

        $username =  $_SESSION['uname'];
        $name = $_SESSION['name'];
        $TABLE_NAME = "course_req_table";

        
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");
?>

    <html>

    <head>
        <link rel="icon" href="./../../favicon.ico">
        <title>eVerify Request Course</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
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
        .helper{
            clear: both;
        }
        [type="checkbox"].filled-in:checked+label:after {
            border: 2px solid #e91e63;
            background-color: #e91e63;
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
                <p id="top-bar" class="card-heading-main red white-text title">REQUEST COURSE</p>
                <div class="card-content">
                    <div class="row">
                        <p class="title text-darken-2">AVAILABLE COURSES<p>
                    </div>
                    
                    <?php
                        $registed_courses = Array();
                        $sql = "SELECT COURSE_ID,STATUS FROM COURSE_REG_TABLE WHERE STUD_ID = '$username'";
                        $db = mysqli_query($link,$sql);
                        if(!$db)
                            die("Failed to Load: ".mysqli_error($link));
                        if(mysqli_num_rows($db) > 0) {
                            while($row = mysqli_fetch_assoc($db)){
                                $registed_courses[$row['COURSE_ID']] = $row['STATUS'];
                            }
                        }

                        $sql = "SELECT * FROM COURSE_TABLE";
                        $db = mysqli_query($link,$sql);
                        if(!$db)
                            die("Failed to Load: ".mysqli_error($link));
                        if(mysqli_num_rows($db) > 0) {
                            while($row = mysqli_fetch_assoc($db)){
                                $course_id = $row['COURSE_ID'];
                                $course_name = $row['COURSE_NAME'];
                                $checkbox_id = "$course_id";
                                $select_id = "SELECT_".$course_id;
                                if(!array_key_exists($course_id, $registed_courses)) {
                                    $html_one = "<div class=\"row list valign-wrapper\"><div class=\"col s2 m1\"><input type=\"checkbox\" class=\"filled-in\" id=\"$checkbox_id\"/><label for=\"$checkbox_id\"></label></div><div class=\"col s4 m4\"><p class=\"text valign\">$course_name</p></div><div class=\"col s12 m6 input-field\"  ><select id=\"$select_id\"><option value=\"\" disabled selected>Select Faculty</option>";
                                    echo $html_one;
                                    
                                    $TABLE_NAME = "COORDINATOR_".$course_id;
                                    $sql_new = "SELECT FACULTY_NAME,FACULTY_ID FROM $TABLE_NAME";
                                    $db_new = mysqli_query($link,$sql_new);
                                    if(!$db_new)
                                        die("Failed to Load Coordinator: ".mysqli_error($link));
                                    if(mysqli_num_rows($db_new) > 0) {
                                        while($row = mysqli_fetch_assoc($db_new)){
                                            $faculty_name = $row['FACULTY_NAME'];
                                            $faculty_id = $row['FACULTY_ID'];
                                            echo "<option value=\"$faculty_id\">"."$faculty_id - $faculty_name"."</option>";
                                        }
                                    }
                                    
                                    $html_two = "</select><label></label></div></div>";
                                    echo $html_two;
                                        
                                } else {
                                    if($registed_courses[$course_id] == 0) {
                                        //Pending Status

                                        $html_one = "<div class=\"row list valign-wrapper\"><div class=\"col s2 m1\"><input type=\"checkbox\" class=\"filled-in\" disabled=\"disabled\"  id=\"$checkbox_id\"/><label for=\"$checkbox_id\"></label></div><div class=\"col s4 m4\"><p class=\"text valign\"> <a class=\"red-text\">$course_name [PENDING] </a> </p></div><div class=\"col s12 m6 input-field\"  ><select id=\"$select_id\">";
                                    echo $html_one;
                                    
                                    $TABLE_NAME = "COORDINATOR_".$course_id;
                                    $sql_new = "SELECT * FROM COURSE_REG_TABLE WHERE STUD_ID = '$username' AND `COURSE_ID` = $course_id";
                                    $db_new = mysqli_query($link,$sql_new);
                                    if(!$db_new)
                                        die("Failed to Load Coordinator: ".mysqli_error($link));
                                    if(mysqli_num_rows($db_new) > 0) {
                                        while($row = mysqli_fetch_assoc($db_new)){
                                            $faculty_id = $row['STAFF_ID'];
                                            //Get Faculty Details
                                            $sql_faculty = "SELECT * FROM USERS_TABLE WHERE `USER_ID` = '$faculty_id' AND `ROLE` = 'F'";
                                            $db_faculty = mysqli_query($link,$sql_faculty);
                                            //echo "<option value=\"\" disabled selected>".$sql_faculty."</option>";
                                            if(!$db_faculty)
                                                die("Failed to Load Coordinator: ".mysqli_error($link));
                                            if(mysqli_num_rows($db_faculty) > 0) {
                                                while($row = mysqli_fetch_assoc($db_faculty)){
                                                    $faculty_text = ($faculty_id)." - ".($row['FIRST_NAME'])." ".($ROW['LAST_NAME']);
                                                    echo "<option value=\"\" disabled selected>".$faculty_text."</option>";
                                                }
                                            }

                                        }
                                    }else {
                                        echo "<option value=\"\" disabled selected>"."Error Occured Contact Admin"."</option>";
                                    }

                                    }else {
                                        //Registered
                                            $html_one = "<div class=\"row list valign-wrapper\"><div class=\"col s2 m1\"><input type=\"checkbox\" class=\"filled-in\" disabled=\"disabled\"  id=\"$checkbox_id\"/><label for=\"$checkbox_id\"></label></div><div class=\"col s4 m4\"><p class=\"text valign\"><a class=\"green-text\">$course_name [REGISTERED] </a> </p></div><div class=\"col s12 m6 input-field\"  ><select id=\"$select_id\">";
                                    echo $html_one;
                                    
                                    $TABLE_NAME = "COORDINATOR_".$course_id;
                                    $sql_new = "SELECT * FROM COURSE_REG_TABLE WHERE STUD_ID = '$username' AND `COURSE_ID` = $course_id";
                                    $db_new = mysqli_query($link,$sql_new);
                                    if(!$db_new)
                                        die("Failed to Load Coordinator: ".mysqli_error($link));
                                    if(mysqli_num_rows($db_new) > 0) {
                                        while($row = mysqli_fetch_assoc($db_new)){
                                            $faculty_id = $row['STAFF_ID'];
                                            //Get Faculty Details
                                            $sql_faculty = "SELECT * FROM USERS_TABLE WHERE `USER_ID` = '$faculty_id' AND `ROLE` = 'F'";
                                            $db_faculty = mysqli_query($link,$sql_faculty);
                                            //echo "<option value=\"\" disabled selected>".$sql_faculty."</option>";
                                            if(!$db_faculty)
                                                die("Failed to Load Coordinator: ".mysqli_error($link));
                                            if(mysqli_num_rows($db_faculty) > 0) {
                                                while($row = mysqli_fetch_assoc($db_faculty)){
                                                    $faculty_text = ($faculty_id)." - ".($row['FIRST_NAME'])." ".($ROW['LAST_NAME']);
                                                    echo "<option value=\"\" disabled selected>".$faculty_text."</option>";
                                                }
                                            }

                                        }
                                    }else {
                                        echo "<option value=\"\" disabled selected>"."Error Occured Contact Admin"."</option>";
                                    }
                                    }
                                    
                                    
                                    $html_two = "</select><label></label></div></div>";
                                    echo $html_two;
                                }
                            }
                        }
                    ?>

                    

                    

                    

                    

                    <div class"row valign">
                        <a class="waves-effect pink waves-light btn right" id="registerBtn">REGISTER</a>
                    </div>
                
                    <div class="helper"> </div>

                </div>
            </div>
        </div>

        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Heading</h4>
                <p>Body Text</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close wave-effect wave-gree btn-flat">Agree</a>
            </div>
        </div>

 


        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <script src="request.js" type="text/javascript"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>

    </html>
