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
    <title>e Lab Staff Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/materialize.min.css" type="text/css" />
    <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
    <script src="managepwd.js" type="text/javascript"></script>
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
        font-size: 1.2em;
    }
    .title {
        margin: 50px;
        margin-bottom: 10px;
        margin-left: 0;
    }
    .btn {
        margin-top: 17px;
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
                Set Test Password
            </div>

            <div class="card-content text">
                <div class="row">
                    <div class="col s6">
                        <div class="input-field col s12">
                            <select id="facultySelectioID">
                                <option value="" disabled selected>Choose Faculty</option>
                                <?php
                                $TABLE_NAME_CCOD = "coordinator_".$course_id;
                                $sql_regid = "SELECT DISTINCT FACULTY_NAME,FACULTY_ID FROM $TABLE_NAME_CCOD";
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
                    </div>
                    <div class="col s6">
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="text" id="passwordInput">
                                <label for="passwordInput">Password</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 right-align">
                        <a id="addFacultyBtn" class="right waves-effect pink waves-light btn">SET PASSWORD</a>
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